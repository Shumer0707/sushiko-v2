<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DeliveryPricingTest extends TestCase
{
    use RefreshDatabase;

    public function test_courier_delivery_price_is_calculated_from_the_order_subtotal(): void
    {
        Mail::fake();
        config()->set([
            'shop.standard_delivery_min_amount' => 200,
            'shop.high_delivery_cost' => 100,
            'shop.free_delivery_amount' => 600,
            'shop.delivery_cost' => 50,
        ]);

        $product = $this->createProduct();

        $cases = [
            [100, 100],
            [199.99, 100],
            [200, 50],
            [550, 50],
            [599.99, 50],
            [600, 0],
        ];

        foreach ($cases as [$subtotal, $expectedDeliveryCost]) {
            $product->update(['price' => $subtotal]);

            $this->post('/ru/order/checkout', $this->checkoutPayload(
                product: $product,
                subtotal: $subtotal,
                deliveryCost: $expectedDeliveryCost,
            ))->assertSessionHasNoErrors();

            $order = Order::query()->latest('id')->firstOrFail();

            $this->assertEquals($expectedDeliveryCost, (float) $order->delivery_cost);
            $this->assertEquals($subtotal + $expectedDeliveryCost, (float) $order->total_with_delivery);
        }
    }

    public function test_pickup_is_always_free(): void
    {
        Mail::fake();

        $product = $this->createProduct(100);
        $payload = $this->checkoutPayload($product, 100, 0);
        $payload['delivery'] = ['method' => 'pickup'];

        $this->post('/ru/order/checkout', $payload)->assertSessionHasNoErrors();

        $order = Order::query()->sole();

        $this->assertEquals(0, (float) $order->delivery_cost);
        $this->assertEquals(100, (float) $order->total_with_delivery);
    }

    private function createProduct(float $price = 100): Product
    {
        $product = Product::create([
            'sku' => 'DELIVERY-PRICING-TEST',
            'price' => $price,
            'currency' => 'MDL',
            'is_active' => true,
        ]);

        $product->translations()->create([
            'language' => 'ru',
            'name' => 'Тестовый товар',
            'slug' => 'delivery-pricing-test',
        ]);

        return $product;
    }

    private function checkoutPayload(Product $product, float $subtotal, float $deliveryCost): array
    {
        return [
            'customer' => [
                'name' => 'Test Client',
                'phone' => '+37378125533',
                'email' => 'client@example.com',
            ],
            'delivery' => [
                'method' => 'delivery',
                'addressType' => 'house',
                'address' => 'Test street',
                'houseNumber' => '1',
            ],
            'payment' => 'cash',
            'comment' => null,
            'items' => [[
                'id' => $product->id,
                'name' => 'Тестовый товар',
                'price' => $subtotal,
                'quantity' => 1,
            ]],
            'total' => $subtotal,
            'deliveryCost' => $deliveryCost,
            'totalWithDelivery' => $subtotal + $deliveryCost,
            'currency' => 'MDL',
            'privacy_accepted' => true,
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderNotificationMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();
        $managerEmail = config('mail.manager_email', 'manager@sushiko.md');

        try {
            DB::beginTransaction();

            $method = $data['delivery']['method'] ?? 'delivery';
            $freeFrom = (float) config('shop.free_delivery_amount', 0);
            $deliveryFee = (float) config('shop.delivery_cost', 0);

            $products = Product::with([
                'translation',
                'promotion',
                'promotion.giftProduct.translation',
            ])
                ->whereIn('id', collect($data['items'])->pluck('id')->filter()->unique()->values())
                ->get()
                ->keyBy('id');

            $resolvedItems = [];
            $total = 0;

            foreach ($data['items'] as $item) {
                $productId = (int) ($item['id'] ?? 0);
                $quantity = max(1, (int) ($item['quantity'] ?? 1));
                $product = $products->get($productId);

                if (!$product || !$product->is_active) {
                    throw new \RuntimeException("Product {$productId} is missing or inactive during checkout.");
                }

                $basePrice = (float) $product->price;
                $price = (float) $product->final_price;
                $promotionType = $product->promotion_type;
                $giftProduct = null;

                if (
                    $promotionType === 'gift'
                    && $product->promotion
                    && $product->promotion->giftProduct
                ) {
                    $giftProduct = [
                        'name' => $product->promotion->giftProduct->translation?->name ?? '',
                        'slug' => $product->promotion->giftProduct->translation?->slug ?? '',
                        'quantity' => (int) ($product->promotion->gift_quantity ?? 1),
                    ];
                }

                $resolvedItem = [
                    'id' => $product->id,
                    'name' => $product->translation?->name ?? ($item['name'] ?? ('Product #' . $product->id)),
                    'quantity' => $quantity,
                    'price' => $price,
                    'base_price' => $basePrice,
                    'has_promotion' => $product->has_active_promotion,
                    'promotion_type' => $promotionType,
                    'gift_product' => $giftProduct,
                ];

                $resolvedItems[] = $resolvedItem;
                $total += $price * $quantity;
            }

            $total = round($total, 2);

            if ($method === 'pickup') {
                $deliveryCost = 0;
            } else {
                $deliveryCost = ($freeFrom > 0 && $total >= $freeFrom) ? 0 : $deliveryFee;
            }

            $totalWithDelivery = round($total + $deliveryCost, 2);

            $order = Order::create([
                'customer_name'        => $data['customer']['name'],
                'customer_phone'       => $data['customer']['phone'],
                'customer_email'       => $data['customer']['email'] ?? null,
                'delivery_method'      => $data['delivery']['method'],
                'address_type'         => $data['delivery']['addressType'] ?? null,
                'address'              => $data['delivery']['address'] ?? null,
                'house_number'         => $data['delivery']['houseNumber'] ?? null,
                'apartment_number'     => $data['delivery']['apartmentNumber'] ?? null,
                'entrance'             => $data['delivery']['entrance'] ?? null,
                'floor'                => $data['delivery']['floor'] ?? null,
                'intercom'             => $data['delivery']['intercom'] ?? null,
                'payment'              => $data['payment'],
                'comment'              => $data['comment'] ?? null,
                'total'                => $total,
                'delivery_cost'        => $deliveryCost,
                'total_with_delivery'  => $totalWithDelivery,
                'currency'             => $data['currency'],
                'status'               => 'new',
            ]);

            foreach ($resolvedItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'] ?? null,
                    'name'       => $item['name'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                    'total'      => $item['price'] * $item['quantity'],
                ]);
            }

            $orderData = $data;
            $orderData['order_id'] = $order->id;
            $orderData['items'] = $resolvedItems;
            $orderData['total'] = $total;
            $orderData['deliveryCost'] = $deliveryCost;
            $orderData['totalWithDelivery'] = $totalWithDelivery;

            $clientTotalWithDelivery = round((float) ($data['totalWithDelivery'] ?? 0), 2);
            if ($clientTotalWithDelivery !== $totalWithDelivery) {
                Log::warning('Checkout total differs from client payload', [
                    'order_id' => $order->id,
                    'client_total_with_delivery' => $clientTotalWithDelivery,
                    'server_total_with_delivery' => $totalWithDelivery,
                    'items' => $resolvedItems,
                ]);
            }

            Mail::to($managerEmail)->send(new OrderNotificationMail($orderData));

            if (!empty($orderData['customer']['email'])) {
                Mail::to($orderData['customer']['email'])
                    ->send(new OrderConfirmationMail($orderData));
            }

            DB::commit();

            return back()->with([
                'success'  => __('common.order_success'),
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Order submission failed', [
                'error' => $e->getMessage(),
                'data'  => $data,
            ]);

            return back()->withErrors(['general' => __('common.order_error')]);
        }
    }
}

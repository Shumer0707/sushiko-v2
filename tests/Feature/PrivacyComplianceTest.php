<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PrivacyComplianceTest extends TestCase
{
    use RefreshDatabase;

    public function test_privacy_document_is_available_in_each_supported_locale(): void
    {
        foreach (['ru', 'ro', 'en'] as $locale) {
            $this->get("/{$locale}/privacy")
                ->assertOk()
                ->assertInertia(fn(Assert $page) => $page
                    ->component('Legal/Privacy')
                    ->where('document.version', '1.0')
                    ->where('document.publishedAt', '2026-08-29')
                    ->where('privacy_policy.version', '1.0')
                    ->has('document.content'));
        }
    }

    public function test_checkout_requires_privacy_acknowledgement(): void
    {
        $this->post('/ru/order/checkout', [])
            ->assertSessionHasErrors('privacy_accepted');
    }

    public function test_checkout_stores_the_policy_version_with_the_order(): void
    {
        Mail::fake();

        $product = Product::create([
            'sku' => 'PRIVACY-TEST-PRODUCT',
            'price' => 100,
            'currency' => 'MDL',
            'is_active' => true,
        ]);

        $product->translations()->create([
            'language' => 'ru',
            'name' => 'Test product',
            'slug' => 'privacy-test-product',
        ]);

        $this->post('/ru/order/checkout', [
            'customer' => [
                'name' => 'Test Client',
                'phone' => '+37378125533',
                'email' => 'client@example.com',
            ],
            'delivery' => ['method' => 'pickup'],
            'payment' => 'cash',
            'comment' => null,
            'items' => [[
                'id' => $product->id,
                'name' => 'Test product',
                'price' => 100,
                'quantity' => 1,
            ]],
            'total' => 100,
            'deliveryCost' => 0,
            'totalWithDelivery' => 100,
            'currency' => 'MDL',
            'privacy_accepted' => true,
        ])->assertSessionHasNoErrors();

        $order = Order::query()->sole();

        $this->assertSame('1.0', $order->privacy_policy_version);
        $this->assertNotNull($order->privacy_accepted_at);
    }

    public function test_contact_form_passes_the_optional_phone_to_the_email(): void
    {
        Mail::fake();

        $this->post('/ru/contact/send', [
            'name' => 'Test Client',
            'email' => 'client@example.com',
            'phone' => '+37378125533',
            'message' => 'Test message',
        ])->assertSessionHasNoErrors();

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail): bool {
            return $mail->data['phone'] === '+37378125533';
        });
    }
}

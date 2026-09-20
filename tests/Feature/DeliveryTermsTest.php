<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DeliveryTermsTest extends TestCase
{
    use RefreshDatabase;

    public function test_delivery_terms_are_available_in_each_supported_locale(): void
    {
        $titles = [
            'ru' => 'Условия доставки',
            'ro' => 'Condiții de livrare',
            'en' => 'Delivery terms',
        ];

        foreach ($titles as $locale => $title) {
            $this->get("/{$locale}/delivery")
                ->assertOk()
                ->assertInertia(fn(Assert $page) => $page
                    ->component('Legal/Delivery')
                    ->where('locale', $locale)
                    ->where('translations.legal.delivery_title', $title)
                    ->where('translations.legal.delivery_rate_below_200', fn($value) => filled($value))
                    ->where('translations.legal.delivery_rate_from_200', fn($value) => filled($value))
                    ->where('translations.legal.delivery_rate_from_600', fn($value) => filled($value)));
        }
    }

    public function test_pickup_address_is_correct_in_the_checkout_and_customer_email_translations(): void
    {
        foreach (['ru', 'ro', 'en'] as $locale) {
            app()->setLocale($locale);

            $this->assertStringContainsString('86', __('common.checkout_pickup_address'));
            $this->assertStringContainsString('86', __('mail.order_email_delivery_pickup_address'));
        }
    }
}

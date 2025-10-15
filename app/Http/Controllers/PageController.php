<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Страница "О нас"
     */
    public function about()
    {
        return Inertia::render('About', [
            'meta' => [
                'title' => __('seo.about_title'),
                'description' => __('seo.about_description'),
                'image' => asset('images/og-default.jpg'),
            ],
        ]);
    }

    /**
     * Страница корзины
     */
    public function cart()
    {
        return Inertia::render('Cart', [
            'meta' => [
                'title' => __('seo.cart_title'),
                'description' => __('seo.cart_description'),
                'image' => asset('images/og-default.jpg'),
            ],
        ]);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Inertia::share([
            'locale' => fn() => app()->getLocale(),
            'current_locale' => fn() => request()->segment(1) ?: 'ru', // локаль из URL
            'csrf_token' => fn() => csrf_token(),
            'translations' => fn() => [
                'common' => trans('common'),
            ],
        ]);
    }
}

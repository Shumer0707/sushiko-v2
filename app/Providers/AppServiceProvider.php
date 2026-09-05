<?php

namespace App\Providers;

use App\Models\ShopSetting;
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
            'current_locale' => fn() => request()->segment(1) ?: 'ru',
            'csrf_token' => fn() => csrf_token(),
            'translations' => fn() => [
                'common' => trans('common'),
                'legal' => trans('legal'),
                'seo' => trans('seo'),
                'maintenance' => ShopSetting::getPublicStatusContent(app()->getLocale()),
            ],
            'privacy_policy' => fn() => [
                'version' => (string) config('legal.privacy.version'),
                'published_at' => (string) config('legal.privacy.published_at'),
            ],
        ]);
    }
}

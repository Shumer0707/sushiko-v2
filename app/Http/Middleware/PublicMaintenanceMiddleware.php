<?php

namespace App\Http\Middleware;

use App\Models\ShopSetting;
use Closure;
use Illuminate\Http\Request;

class PublicMaintenanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $isDisabled = ShopSetting::getBool(ShopSetting::KEY_PUBLIC_DISABLED);

        $isMaintenanceRoute = $request->routeIs('maintenance');
        $locale = (string) $request->route('locale');

        // 1) Сайт ВКЛЮЧЕН, но пользователь на maintenance → домой
        if (! $isDisabled && $isMaintenanceRoute) {
            return redirect()->route('home', ['locale' => $locale]);
        }

        // 2) Сайт ВЫКЛЮЧЕН, и это не maintenance → на maintenance
        if ($isDisabled && ! $isMaintenanceRoute) {
            return redirect()->route('maintenance', ['locale' => $locale]);
        }

        return $next($request);
    }
}

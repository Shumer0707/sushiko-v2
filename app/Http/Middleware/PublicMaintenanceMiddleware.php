<?php

namespace App\Http\Middleware;

use App\Models\ShopSetting;
use Closure;
use Illuminate\Http\Request;

class PublicMaintenanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $override = config('shop.public_disabled_override');

        if ($override !== null && $override !== '') {
            $isDisabled = $this->toBool($override);
        } else {
            $val = ShopSetting::getValue(ShopSetting::KEY_PUBLIC_DISABLED, '0');
            $isDisabled = $this->toBool($val);
        }

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


    private function toBool(mixed $value): bool
    {
        if (is_bool($value)) return $value;
        if ($value === null) return false;

        $v = strtolower(trim((string) $value));

        if (in_array($v, ['0', 'false', 'off', 'no', 'n'], true)) return false;

        return in_array($v, ['1', 'true', 'on', 'yes', 'y'], true);
    }
}

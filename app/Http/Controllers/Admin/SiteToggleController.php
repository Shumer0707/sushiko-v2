<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSetting;
use Illuminate\Http\Request;

class SiteToggleController extends Controller
{
    public function toggle(Request $request)
    {
        $current = ShopSetting::getValue(ShopSetting::KEY_PUBLIC_DISABLED, '0');

        $newValue = $current === '1' ? '0' : '1';

        ShopSetting::setValue(ShopSetting::KEY_PUBLIC_DISABLED, $newValue);

        return redirect()->route('dashboard')->with(
            'success',
            $newValue === '1'
                ? 'Публичная часть сайта выключена'
                : 'Публичная часть сайта включена'
        );
    }
}

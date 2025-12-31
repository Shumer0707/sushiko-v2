<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSetting;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'siteDisabled' => ShopSetting::getValue(
                ShopSetting::KEY_PUBLIC_DISABLED,
                '0'
            ) === '1',
        ]);
    }
}

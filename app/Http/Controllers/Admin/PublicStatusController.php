<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettings\UpdatePublicStatusContentRequest;
use App\Models\ShopSetting;
use Inertia\Inertia;

class PublicStatusController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/SiteSettings/PublicStatus', [
            'siteDisabled' => ShopSetting::getBool(ShopSetting::KEY_PUBLIC_DISABLED),
            'content' => ShopSetting::getEditablePublicStatusContent(),
        ]);
    }

    public function update(UpdatePublicStatusContentRequest $request)
    {
        $validated = $request->validated();

        ShopSetting::setValue(ShopSetting::KEY_PUBLIC_DISABLED, $validated['is_disabled']);
        ShopSetting::setJson(ShopSetting::KEY_PUBLIC_STATUS_CONTENT, $validated['content']);

        return redirect()
            ->route('admin.public-status.edit')
            ->with('success', 'Настройки страницы недоступности обновлены');
    }
}

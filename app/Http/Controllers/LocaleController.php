<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        // Проверяем, поддерживается ли локаль
        if (!in_array($locale, config('app.supported_locales'))) {
            return back();
        }

        // Получаем предыдущий URL
        $previousUrl = url()->previous();

        // Если пришли с локализованной страницы - меняем локаль в URL
        if (preg_match('#^' . url('/') . '/(ru|ro|en)(/.*)?$#', $previousUrl, $matches)) {
            $currentPath = $matches[2] ?? '/';
            return redirect("/{$locale}{$currentPath}");
        }

        // Если пришли с нелокализованной страницы (админка и т.д.) - возвращаемся назад
        return back();
    }
}

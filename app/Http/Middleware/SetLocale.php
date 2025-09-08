<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Получаем локаль из первого сегмента URL
        $locale = $request->segment(1);

        // Проверяем, поддерживается ли локаль
        if (in_array($locale, config('app.supported_locales'))) {
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            // Если локаль не указана или не поддерживается - используем дефолтную
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 301 Редиректы со старого сайта (WordPress) на новый (Laravel)
|--------------------------------------------------------------------------
| Это критично для сохранения позиций в Google!
*/

// Главная (русская) → /ru
Route::redirect('/', '/ru', 301);

// Главная (румынская) → /ro
Route::get('/ro/welcome', function () {
    return redirect('/ro', 301);
});
Route::get('/ro/welcome/', function () {
    return redirect('/ro', 301);
});

Route::get('/product/{slug}', function ($slug) {
    // Убираем слэш в конце
    $slug = rtrim($slug, '/');

    return redirect("/ru/product/{$slug}", 301);
})->where('slug', '[a-z0-9-]+');

Route::get('/ro/product/{slug}', function ($slug) {
    $slug = rtrim($slug, '/');

    // Проверяем есть ли цифра в конце
    if (preg_match('/-\d+$/', $slug)) {
        // Есть цифра → убираем и редиректим
        $cleanSlug = preg_replace('/-\d+$/', '', $slug);
        return redirect("/ro/product/{$cleanSlug}", 301);
    }

    return redirect()->route('product.show', ['locale' => 'ro', 'slug' => $slug]);
})->where('slug', '[a-z0-9-]+');

Route::get('/product-category/{any}', function () {
    return redirect('/ru', 301);
})->where('any', '.*');

Route::get('/ro/product-category/{any}', function () {
    return redirect('/ro', 301);
})->where('any', '.*');


// Категории → главная
Route::get('/product-category/{any}', function () {
    return redirect('/ru', 301);
})->where('any', '.*');

Route::get('/ro/product-category/{any}', function () {
    return redirect('/ro', 301);
})->where('any', '.*');

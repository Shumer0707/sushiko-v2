<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public Routes (с локализацией)
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ru|ro|en']], function () {

    Route::get('/', [ProductController::class, 'index'])->name('home');

    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/cart', fn() => Inertia::render('Cart'))->name('cart.index');
    Route::get('/about', fn() => Inertia::render('About'))->name('about');
    Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // API для категорий (если нужно)
    Route::get('/api/category/{slug}/products', [ProductController::class, 'byCategory'])->name('category.products');
});
// Переключение языка
Route::post('/switch-locale', [LocaleController::class, 'switch'])->name('locale.switch');

// Редирект с корня на ru
Route::get('/', fn() => redirect('/ru'));

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Стандартный dashboard для Breeze
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))
        ->middleware('verified')
        ->name('dashboard');

    // Профиль пользователя
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

// Подключаем админ-роуты
require __DIR__ . '/admin.php';

// Подключаем роуты авторизации
require __DIR__ . '/auth.php';

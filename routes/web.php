<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Public Routes (с локализацией)
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ru|ro|en']], function () {

    // Главная (каталог товаров)
    Route::get('/', [ProductController::class, 'index'])->name('home');

    // Товар
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

    // Статические страницы
    Route::get('/cart', [PageController::class, 'cart'])->name('cart.index');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Отправка формы контактов
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // Оформление заказа
    Route::post('/order/checkout', [OrderController::class, 'store'])->name('order.checkout');

    // API для категорий
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
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))
        ->middleware('verified')
        ->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/redirects.php';

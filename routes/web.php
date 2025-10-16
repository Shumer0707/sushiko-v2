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
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/cart', [PageController::class, 'cart'])->name('cart.index');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
    Route::post('/order/checkout', [OrderController::class, 'store'])->name('order.checkout');
    Route::get('/api/category/{slug}/products', [ProductController::class, 'byCategory'])->name('category.products');
});

Route::post('/switch-locale', [LocaleController::class, 'switch'])->name('locale.switch');

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
/*
|--------------------------------------------------------------------------
| 🔥 404 ERROR PAGE (В САМОМ КОНЦЕ!)
|--------------------------------------------------------------------------
| Fallback route - ловит все несуществующие URL
*/

Route::fallback(function () {
    return Inertia::render('Errors/404', [
        'status' => 404,
    ])->toResponse(request())->setStatusCode(404);
});

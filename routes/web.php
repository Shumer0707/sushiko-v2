<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes (с локализацией)
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ru|ro|en']], function () {
    Route::get('/', fn() => Inertia::render('Home'))->name('home');
    Route::get('/about', fn() => Inertia::render('About'))->name('about');
    Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

/*
|--------------------------------------------------------------------------
| Нелокализованные Routes
|--------------------------------------------------------------------------
*/

// Route::get('api/categories', [CategoryController::class, 'index']);
// Route::get('/categories/main', [CategoryController::class, 'main']);

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

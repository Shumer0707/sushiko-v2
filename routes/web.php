<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ContactController;
use \App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'ru|ro|en']], function () {
    // Только публичные страницы
    Route::get('/', fn() => Inertia::render('Home'))->name('home');
    Route::get('/about', fn() => Inertia::render('About'))->name('about');
    Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});


/*
|--------------------------------------------------------------------------
| Нелокализованные роуты (авторизация, админка)
|--------------------------------------------------------------------------
*/
// Переключение языка
Route::post('/switch-locale', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware(['auth'])->group(function () {
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Стандартный dashboard для Breeze (чтобы AuthenticatedLayout не ломался)
Route::get('/dashboard', fn() => Inertia::render('Dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => Inertia::render('Admin/Dashboard'))
        ->name('admin.dashboard');

    // Категории
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/admin/brands', [BrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/admin/brands/{id}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/admin/brands/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/admin/brands/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Атрибуты
    Route::get('/admin/attributes', [AttributeController::class, 'index'])->name('admin.attributes.index');
    Route::get('/admin/attributes/create', [AttributeController::class, 'create'])->name('admin.attributes.create');
    Route::post('/admin/attributes', [AttributeController::class, 'store'])->name('admin.attributes.store');
    Route::get('/admin/attributes/{attribute}/edit', [AttributeController::class, 'edit'])->name('admin.attributes.edit');
    Route::put('/admin/attributes/{attribute}', [AttributeController::class, 'update'])->name('admin.attributes.update');
    Route::delete('/admin/attributes/{attribute}', [AttributeController::class, 'destroy'])->name('admin.attributes.destroy');

    Route::prefix('/admin/attributes/{attribute}')->group(function () {
        Route::get('/values', [AttributeValueController::class, 'index'])->name('admin.attribute-values.index');
        Route::get('/values/create', [AttributeValueController::class, 'create'])->name('admin.attribute-values.create');
        Route::post('/values', [AttributeValueController::class, 'store'])->name('admin.attribute-values.store');
        Route::get('/values/{value}/edit', [AttributeValueController::class, 'edit'])->name('admin.attribute-values.edit');
        Route::put('/values/{value}', [AttributeValueController::class, 'update'])->name('admin.attribute-values.update');
        Route::delete('/values/{value}', [AttributeValueController::class, 'destroy'])->name('admin.attribute-values.destroy');
    });
});

// Редирект с корня
Route::get('/', function () {
    return redirect('/ru');
});

// Редирект с корня
Route::get('/', function () {
    return redirect('/ru');
});

require __DIR__ . '/auth.php';

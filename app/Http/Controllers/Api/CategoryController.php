<?php
// app/Http/Controllers/Api/CategoryController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Получить категории для навигации в хедере
     */
    public function getNavigationCategories()
    {
        $locale = app()->getLocale();

        return Cache::remember("navigation_categories_{$locale}", 3600, function () {
            return Category::with('translation')
                ->whereNull('parent_id') // только главные категории
                ->orderBy('id') // потом можем добавить sort_order
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->translatedName(),
                        'slug' => $category->translation->slug ?? '',
                    ];
                });
        });
    }
}

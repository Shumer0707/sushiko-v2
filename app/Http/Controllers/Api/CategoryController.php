<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function getNavigationCategories()
    {
        $locale = app()->getLocale();

        return Cache::remember("navigation_categories_{$locale}", 3600, function () {
            return Category::with('translation')
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->translatedName(),
                        'slug' => $category->translation->slug ?? '',
                        'image_url' => $category->image_url,
                    ];
                });
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Главная страница - все товары сразу
     * Загружаем всё одним запросом для быстродействия
     */
    public function index()
    {
        // Получаем текущий язык (ru, ro, en)
        $locale = app()->getLocale();

        // Загружаем ВСЕ активные товары с нужными связями
        $products = Product::with([
            'translation',           // Перевод товара на текущем языке
            'category.translation',  // Категория с переводом
            'brand.translation',     // Бренд с переводом
            'images' => function ($query) {
                // Берём главное фото или первое по порядку
                $query->orderBy('is_main', 'desc')
                    ->orderBy('sort_order', 'asc');
            }
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) {
                // Форматируем данные для фронта
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'currency' => $product->currency,

                    // Переводы
                    'name' => $product->translation?->name ?? 'No name',
                    'slug' => $product->translation?->slug ?? '',
                    'short_description' => $product->translation?->short_description ?? '',

                    // Категория
                    'category' => [
                        'id' => $product->category?->id,
                        'name' => $product->category?->translation?->name ?? '',
                        'slug' => $product->category?->translation?->slug ?? '',
                        'image_url' => $product->category?->image_url ?? '',
                    ],

                    // Бренд
                    'brand' => [
                        'id' => $product->brand?->id,
                        'name' => $product->brand?->translation?->name ?? '',
                        'slug' => $product->brand?->translation?->slug ?? '',
                        'logo_url' => $product->brand?->logo_url ?? '',
                    ],

                    // 🔹 здесь маленькая, если есть, иначе — главная
                    'image_url'        => $product->small_image_url,

                    // 🔹 а если где-то на фронте понадобится строго главное — оно тоже есть
                    'main_image_url'   => $product->main_image_url,
                ];
            });

        // Загружаем категории для фильтров
        $categories = Category::with('translation')
            ->whereNull('parent_id') // Только родительские
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->translation?->name ?? '',
                    'slug' => $category->translation?->slug ?? '',
                    'image_url' => $category->image_url,
                ];
            });

        // Отправляем на главную страницу
        return Inertia::render('Home', [
            'meta' => [
                'title' => __('seo.home_title'),
                'description' => __('seo.home_description'),
                'image' => asset('images/og-home.jpg'), // Создашь позже
            ],
            'products' => $products,
            'categories' => $categories,
            'locale' => $locale,
        ]);
    }

    /**
     * Детальная страница товара
     * Показываем всю информацию о товаре
     */
    /**
     * Детальная страница товара
     * Показываем всю информацию о товаре
     */
    public function show($locale, $slug)
    {
        // Ищем товар по slug в переводах
        $product = Product::with([
            'translations',
            'translation',
            'category.translation',
            'brand.translation',
            'images' => function ($query) {
                $query->orderBy('is_main', 'desc')
                    ->orderBy('sort_order', 'asc');
            },
            'attributeValues.attribute.translation',
            'attributeValues.translation',
        ])
            ->whereHas('translation', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->where('is_active', true)
            ->firstOrFail();

        // Форматируем данные
        $productData = [
            'id' => $product->id,
            'sku' => $product->sku,
            'price' => $product->price,
            'currency' => $product->currency,
            'name' => $product->translation?->name ?? '',
            'slug' => $product->translation?->slug ?? '',
            'short_description' => $product->translation?->short_description ?? '',
            'description' => $product->translation?->full_description ?? '',
            'ingredients' => null,
            'category' => [
                'id' => $product->category?->id,
                'name' => $product->category?->translation?->name ?? '',
                'slug' => $product->category?->translation?->slug ?? '',
                'image_url' => $product->category?->image_url ?? '',
            ],
            'brand' => [
                'id' => $product->brand?->id,
                'name' => $product->brand?->translation?->name ?? '',
                'slug' => $product->brand?->translation?->slug ?? '',
                'logo_url' => $product->brand?->logo_url ?? '',
            ],
            'image_url' => $product->main_image_url,
            'images' => $product->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => asset('storage/' . $image->path),
                    'is_main' => $image->is_main,
                ];
            }),
            'attributes' => $product->attributeValues->groupBy(function ($attributeValue) {
                return $attributeValue->attribute->id;
            })->map(function ($values, $attributeId) {
                $firstValue = $values->first();
                return [
                    'id' => $attributeId,
                    'name' => $firstValue->attribute->translation?->name ?? '',
                    'type' => $firstValue->attribute->type,
                    'values' => $values->map(function ($value) {
                        return [
                            'id' => $value->id,
                            'value' => $value->translation?->value ?? '',
                        ];
                    })->values(),
                ];
            })->values(),
        ];

        // Похожие товары
        $relatedProducts = Product::with([
            'translation',
            'category.translation',
            'images'
        ])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->translation?->name ?? '',
                    'slug' => $p->translation?->slug ?? '',
                    'price' => $p->price,
                    'currency' => $p->currency,
                    'image_url' => $p->main_image_url,
                    'category_name' => $p->category?->translation?->name ?? '',
                ];
            });

        // 🔥 ДОБАВЛЯЕМ SEO ДАННЫЕ
        return Inertia::render('Product', [
            // SEO для ботов (с подстановкой данных товара)
            'meta' => [
                'title' => __('seo.product_title', [
                    'name' => $product->translation?->name ?? ''
                ]),
                'description' => __('seo.product_description', [
                    'name' => $product->translation?->name ?? '',
                    'short_description' => $product->translation?->short_description ?? ''
                ]),
                // Используем главное фото товара для соцсетей
                'image' => $product->main_image_url
                    ? (str_starts_with($product->main_image_url, 'http')
                        ? $product->main_image_url
                        : asset($product->main_image_url))
                    : asset('images/og-default.jpg'),
            ],

            // Данные страницы
            'product' => $productData,
            'relatedProducts' => $relatedProducts,
            'locale' => app()->getLocale(),
        ]);
    }

    /**
     * API метод для фильтрации по категории (опционально)
     * Если захочешь делать AJAX подгрузку
     */
    public function byCategory($categorySlug)
    {
        $locale = app()->getLocale();

        $category = Category::whereHas('translation', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->firstOrFail();

        $products = Product::with([
            'translation',
            'category.translation',
            'brand.translation',
            'images'
        ])
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->translation?->name ?? '',
                    'slug' => $product->translation?->slug ?? '',
                    'price' => $product->price,
                    'currency' => $product->currency,
                    'short_description' => $product->translation?->short_description ?? '',
                    'image_url' => $product->main_image_url,
                    'category' => [
                        'name' => $product->category?->translation?->name ?? '',
                        'slug' => $product->category?->translation?->slug ?? '',
                    ],
                ];
            });

        return response()->json([
            'products' => $products,
            'category' => [
                'id' => $category->id,
                'name' => $category->translation?->name ?? '',
                'slug' => $category->translation?->slug ?? '',
            ]
        ]);
    }
}

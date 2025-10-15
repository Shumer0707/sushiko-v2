<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Массив категорий в нужном порядке
        $categories = [
            [
                'image' => 'categories/sets.jpg',
                'sort_order' => 1,
                'translations' => [
                    'ru' => ['name' => 'СЕТЫ', 'slug' => 'sets'],
                    'ro' => ['name' => 'SETURI', 'slug' => 'seturi'],
                    'en' => ['name' => 'SETS', 'slug' => 'sets'],
                ]
            ],
            [
                'image' => 'categories/uramaki.jpg',
                'sort_order' => 2,
                'translations' => [
                    'ru' => ['name' => 'УРАМАКИ', 'slug' => 'uramaki'],
                    'ro' => ['name' => 'URAMAKI', 'slug' => 'uramaki'],
                    'en' => ['name' => 'URAMAKI', 'slug' => 'uramaki'],
                ]
            ],
            [
                'image' => 'categories/hosomaki.jpg',
                'sort_order' => 3,
                'translations' => [
                    'ru' => ['name' => 'ХОСОМАКИ', 'slug' => 'hosomaki'],
                    'ro' => ['name' => 'HOSOMAKI', 'slug' => 'hosomaki'],
                    'en' => ['name' => 'HOSOMAKI', 'slug' => 'hosomaki'],
                ]
            ],
            [
                'image' => 'categories/tempura.jpg',
                'sort_order' => 4,
                'translations' => [
                    'ru' => ['name' => 'ТЕМПУРА', 'slug' => 'tempura'],
                    'ro' => ['name' => 'TEMPURA', 'slug' => 'tempura'],
                    'en' => ['name' => 'TEMPURA', 'slug' => 'tempura'],
                ]
            ],
            [
                'image' => 'categories/burgers.jpg',
                'sort_order' => 5,
                'translations' => [
                    'ru' => ['name' => 'БУРГЕРЫ', 'slug' => 'burgers'],
                    'ro' => ['name' => 'BURGER', 'slug' => 'burger'],
                    'en' => ['name' => 'BURGERS', 'slug' => 'burgers'],
                ]
            ],
            [
                'image' => 'categories/nigiri.jpg',
                'sort_order' => 6,
                'translations' => [
                    'ru' => ['name' => 'НИГИРИ', 'slug' => 'nigiri'],
                    'ro' => ['name' => 'NIGIRI', 'slug' => 'nigiri'],
                    'en' => ['name' => 'NIGIRI', 'slug' => 'nigiri'],
                ]
            ],
            [
                'image' => 'categories/gunkan.jpg',
                'sort_order' => 7,
                'translations' => [
                    'ru' => ['name' => 'ГУНКАН', 'slug' => 'gunkan'],
                    'ro' => ['name' => 'GUNKAN', 'slug' => 'gunkan'],
                    'en' => ['name' => 'GUNKAN', 'slug' => 'gunkan'],
                ]
            ],
            [
                'image' => 'categories/sashimi.jpg',
                'sort_order' => 8,
                'translations' => [
                    'ru' => ['name' => 'САШИМИ', 'slug' => 'sashimi'],
                    'ro' => ['name' => 'SASHIMI', 'slug' => 'sashimi'],
                    'en' => ['name' => 'SASHIMI', 'slug' => 'sashimi'],
                ]
            ],
            [
                'image' => 'categories/sunomono.jpg',
                'sort_order' => 9,
                'translations' => [
                    'ru' => ['name' => 'СУНОМОНО', 'slug' => 'sunomono'],
                    'ro' => ['name' => 'SUNOMONO', 'slug' => 'sunomono'],
                    'en' => ['name' => 'SUNOMONO', 'slug' => 'sunomono'],
                ]
            ],
            [
                'image' => 'categories/rice.jpg',
                'sort_order' => 10,
                'translations' => [
                    'ru' => ['name' => 'РИС', 'slug' => 'rice'],
                    'ro' => ['name' => 'OREZ', 'slug' => 'orez'],
                    'en' => ['name' => 'RICE', 'slug' => 'rice'],
                ]
            ],
            [
                'image' => 'categories/noodles.jpg',
                'sort_order' => 11,
                'translations' => [
                    'ru' => ['name' => 'ЛАПША', 'slug' => 'noodles'],
                    'ro' => ['name' => 'TĂIȚEI', 'slug' => 'taitei'],
                    'en' => ['name' => 'NOODLES', 'slug' => 'noodles'],
                ]
            ],
            [
                'image' => 'categories/soup.jpg',
                'sort_order' => 12,
                'translations' => [
                    'ru' => ['name' => 'СУП', 'slug' => 'soup'],
                    'ro' => ['name' => 'SUPĂ', 'slug' => 'supa'],
                    'en' => ['name' => 'SOUP', 'slug' => 'soup'],
                ]
            ],
            [
                'image' => 'categories/drinks.jpg',
                'sort_order' => 13,
                'translations' => [
                    'ru' => ['name' => 'НАПИТКИ', 'slug' => 'drinks'],
                    'ro' => ['name' => 'BĂUTURI', 'slug' => 'bauturi'],
                    'en' => ['name' => 'DRINKS', 'slug' => 'drinks'],
                ]
            ],
        ];

        // Проходимся по каждой категории
        foreach ($categories as $categoryData) {
            // Создаём саму категорию
            $category = Category::create([
                'image' => $categoryData['image'],
                'parent_id' => null, // пока без вложенности
                'sort_order' => $categoryData['sort_order'],
            ]);

            // Создаём переводы для каждого языка
            foreach ($categoryData['translations'] as $lang => $translation) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'slug' => $translation['slug']
                ]);
            }
        }
    }
}

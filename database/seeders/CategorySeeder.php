<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            [
                'parent_id' => null,
                'translations' => [
                    'ru' => 'Строительные материалы',
                    'ro' => 'Materiale de construcție',
                    'en' => 'Building materials',
                ]
            ],
            [
                'parent_id' => null,
                'translations' => [
                    'ru' => 'Инструменты',
                    'ro' => 'Unelte',
                    'en' => 'Tools',
                ]
            ],
        ];

        foreach ($categoriesData as $data) {
            $category = Category::create(['parent_id' => $data['parent_id']]);

            foreach ($data['translations'] as $lang => $name) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language' => $lang,
                    'name' => $name
                ]);
            }
        }
    }
}

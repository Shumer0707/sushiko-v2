<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\BrandTranslation;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        // Массив брендов
        $brands = [
            [
                'logo' => '',
                'is_active' => true,
                'sort_order' => 1,
                'translations' => [
                    'ru' => ['name' => 'Sushiko', 'slug' => 'sushiko'],
                    'ro' => ['name' => 'Sushiko', 'slug' => 'sushiko'],
                    'en' => ['name' => 'Sushiko', 'slug' => 'sushiko'],
                ]
            ],
        ];

        // Создаём бренды
        foreach ($brands as $brandData) {
            // Создаём сам бренд
            $brand = Brand::create([
                'logo' => $brandData['logo'],
                'is_active' => $brandData['is_active'],
                'sort_order' => $brandData['sort_order']
            ]);

            // Создаём переводы для каждого языка
            foreach ($brandData['translations'] as $lang => $translation) {
                BrandTranslation::create([
                    'brand_id' => $brand->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'slug' => $translation['slug']
                ]);
            }
        }
    }
}

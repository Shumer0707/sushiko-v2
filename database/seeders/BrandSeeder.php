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
                'logo' => 'brands/salmon-king.jpg',
                'is_active' => true,
                'sort_order' => 1,
                'translations' => [
                    'ru' => ['name' => 'SALMON KING', 'slug' => 'salmon-king'],
                    'ro' => ['name' => 'SALMON KING', 'slug' => 'salmon-king'],
                    'en' => ['name' => 'SALMON KING', 'slug' => 'salmon-king'],
                ]
            ],
            [
                'logo' => 'brands/rice-master.jpg',
                'is_active' => true,
                'sort_order' => 2,
                'translations' => [
                    'ru' => ['name' => 'RICE MASTER', 'slug' => 'rice-master'],
                    'ro' => ['name' => 'RICE MASTER', 'slug' => 'rice-master'],
                    'en' => ['name' => 'RICE MASTER', 'slug' => 'rice-master'],
                ]
            ],
            [
                'logo' => 'brands/ocean-fresh.jpg',
                'is_active' => true,
                'sort_order' => 3,
                'translations' => [
                    'ru' => ['name' => 'OCEAN FRESH', 'slug' => 'ocean-fresh'],
                    'ro' => ['name' => 'OCEAN FRESH', 'slug' => 'ocean-fresh'],
                    'en' => ['name' => 'OCEAN FRESH', 'slug' => 'ocean-fresh'],
                ]
            ]
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

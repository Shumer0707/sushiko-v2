<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederSunomono extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: HIYASHI WAKAME ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 9, // SUNOMONO
            'sku' => 'HIYASHI-WAKAME',
            'price' => 70.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'HIYASHI WAKAME',
            'slug' => 'hiyashi-wakame',
            'short_description' => 'Вакаме, соус унаги. 120 г.',
            'full_description' => 'HIYASHI WAKAME — салат из морских водорослей вакаме с соусом унаги. Легкое и освежающее блюдо. Вес 120 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'HIYASHI WAKAME',
            'slug' => 'hiyashi-wakame',
            'short_description' => 'Wakame, sos unagi. 120 g.',
            'full_description' => 'HIYASHI WAKAME — salată de alge marine wakame cu sos unagi. O gustare ușoară și răcoritoare. Greutate 120 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'HIYASHI WAKAME',
            'slug' => 'hiyashi-wakame',
            'short_description' => 'Wakame, unagi sauce. 120 g.',
            'full_description' => 'HIYASHI WAKAME — seaweed wakame salad with unagi sauce. A light and refreshing dish. Weight 120 g.',
        ]);

        // ========== ТОВАР 2: HIYASHI WAKAME CU SOS DE NUCI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 9, // SUNOMONO
            'sku' => 'HIYASHI-WAKAME-CU-SOS-DE-NUCI',
            'price' => 75.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'HIYASHI WAKAME с ореховым соусом',
            'slug' => 'hiyashi-wakame-cu-sos-de-nuci',
            'short_description' => 'Вакаме 120 г, ореховый соус 20 г. Всего 140 г.',
            'full_description' => 'HIYASHI WAKAME с ореховым соусом — салат из морских водорослей вакаме, подается с нежным ореховым соусом. Легкое и питательное блюдо. Вес 140 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'HIYASHI WAKAME CU SOS DE NUCI',
            'slug' => 'hiyashi-wakame-cu-sos-de-nuci',
            'short_description' => 'Wakame 120 g, sos de nuci 20 g. Total 140 g.',
            'full_description' => 'HIYASHI WAKAME CU SOS DE NUCI — salată de alge wakame servită cu sos de nuci cremos. Ușoară și hrănitoare. Greutate 140 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'HIYASHI WAKAME WITH NUT SAUCE',
            'slug' => 'hiyashi-wakame-cu-sos-de-nuci',
            'short_description' => 'Wakame 120 g, nut sauce 20 g. Total 140 g.',
            'full_description' => 'HIYASHI WAKAME WITH NUT SAUCE — wakame seaweed salad served with creamy nut sauce. Light and nutritious. Weight 140 g.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederGunkane extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: SHAKE GUNKANE ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 7, // Gunkane
            'sku' => 'SHAKE-GUNKANE',
            'price' => 125.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'SHAKE GUNKANE',
            'slug' => 'shake-gunkane',
            'short_description' => '3 шт. с рисом и лососем',
            'full_description' => 'Shake Gunkane — 3 аккуратных кусочка с рисом, лососем и острым соусом. Вес 135 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'SHAKE GUNKANE',
            'slug' => 'shake-gunkane',
            'short_description' => '3 buc. cu orez și somon',
            'full_description' => 'Shake Gunkane — 3 bucăți delicate cu orez, somon și sos picant. Greutate 135 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'SHAKE GUNKANE',
            'slug' => 'shake-gunkane',
            'short_description' => '3 pcs with rice and salmon',
            'full_description' => 'Shake Gunkane — 3 neat pieces with rice, salmon, and spicy sauce. Weight 135 g.',
        ]);

        // ========== ТОВАР 2: TOBICO GUNKANE ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 7, // Gunkane
            'sku' => 'TOBICO-GUNKANE',
            'price' => 135.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'TOBICO GUNKANE',
            'slug' => 'tobico-gunkane',
            'short_description' => '3 шт. с икрой тобико',
            'full_description' => 'Tobico Gunkane — 3 аккуратных кусочка с рисом и икрой тобико. Вес 135 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'TOBICO GUNKANE',
            'slug' => 'tobico-gunkane',
            'short_description' => '3 buc. cu icre Tobiko',
            'full_description' => 'Tobico Gunkane — 3 bucăți delicate cu orez și icre Tobiko. Greutate 135 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'TOBICO GUNKANE',
            'slug' => 'tobico-gunkane',
            'short_description' => '3 pcs with Tobiko roe',
            'full_description' => 'Tobico Gunkane — 3 neat pieces with rice and Tobiko roe. Weight 135 g.',
        ]);

        // ========== ТОВАР 3: EBI GUNKANE ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 7, // Gunkane
            'sku' => 'EBI-GUNKANE',
            'price' => 100.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'EBI GUNKANE',
            'slug' => 'ebi-gunkane',
            'short_description' => '3 шт. с креветкой и острым соусом',
            'full_description' => 'Ebi Gunkane — 3 аккуратных кусочка с рисом, креветкой и острым соусом. Вес 135 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'EBI GUNKANE',
            'slug' => 'ebi-gunkane',
            'short_description' => '3 buc. cu creveți și sos picant',
            'full_description' => 'Ebi Gunkane — 3 bucăți delicate cu orez, creveți și sos picant. Greutate 135 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'EBI GUNKANE',
            'slug' => 'ebi-gunkane',
            'short_description' => '3 pcs with shrimp and spicy sauce',
            'full_description' => 'Ebi Gunkane — 3 neat pieces with rice, shrimp, and spicy sauce. Weight 135 g.',
        ]);

        // ========== ТОВАР 4: UNAGHI GUNKANE ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 7, // Gunkane
            'sku' => 'UNAGHI-GUNKANE',
            'price' => 140.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'UNAGHI GUNKANE',
            'slug' => 'unaghi-gunkane',
            'short_description' => '3 шт. с угрём и острым соусом',
            'full_description' => 'Unaghi Gunkane — 3 аккуратных кусочка с рисом, угрём и острым соусом. Вес 105 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'UNAGHI GUNKANE',
            'slug' => 'unaghi-gunkane',
            'short_description' => '3 buc. cu anghilă și sos picant',
            'full_description' => 'Unaghi Gunkane — 3 bucăți delicate cu orez, anghilă și sos picant. Greutate 105 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'UNAGHI GUNKANE',
            'slug' => 'unaghi-gunkane',
            'short_description' => '3 pcs with eel and spicy sauce',
            'full_description' => 'Unaghi Gunkane — 3 neat pieces with rice, eel, and spicy sauce. Weight 105 g.',
        ]);
    }
}

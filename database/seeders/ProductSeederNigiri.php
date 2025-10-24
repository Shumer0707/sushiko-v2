<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederNigiri extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: SHAKE NIGIRI ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 6, // Nigiri
            'sku' => 'SHAKE-NIGIRI',
            'price' => 100.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'SHAKE NIGIRI',
            'slug' => 'shake-nigiri',
            'short_description' => '3 шт. с рисом и лососем',
            'full_description' => 'Shake Nigiri — 3 аккуратных кусочка с рисом и лососем. Вес 105 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'SHAKE NIGIRI',
            'slug' => 'shake-nigiri',
            'short_description' => '3 buc. cu orez și somon',
            'full_description' => 'Shake Nigiri — 3 bucăți delicate cu orez și somon. Greutate 105 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'SHAKE NIGIRI',
            'slug' => 'shake-nigiri',
            'short_description' => '3 pcs with rice and salmon',
            'full_description' => 'Shake Nigiri — 3 neat pieces with rice and salmon. Weight 105 g.',
        ]);

        // ========== ТОВАР 2: EBI NIGIRI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 6, // Nigiri
            'sku' => 'EBI-NIGIRI',
            'price' => 70.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'EBI NIGIRI',
            'slug' => 'ebi-nigiri',
            'short_description' => '3 шт. с рисом и креветкой',
            'full_description' => 'Ebi Nigiri — 3 аккуратных кусочка с рисом и креветкой. Вес 105 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'EBI NIGIRI',
            'slug' => 'ebi-nigiri',
            'short_description' => '3 buc. cu orez și crevete',
            'full_description' => 'Ebi Nigiri — 3 bucăți delicate cu orez și crevete. Greutate 105 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'EBI NIGIRI',
            'slug' => 'ebi-nigiri',
            'short_description' => '3 pcs with rice and shrimp',
            'full_description' => 'Ebi Nigiri — 3 neat pieces with rice and shrimp. Weight 105 g.',
        ]);

        // ========== ТОВАР 3: MAGURO NIGIRI ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 6, // Nigiri
            'sku' => 'MAGURO-NIGIRI',
            'price' => 80.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'MAGURO NIGIRI',
            'slug' => 'maguro-nigiri',
            'short_description' => '3 шт. с рисом и тунцом',
            'full_description' => 'Maguro Nigiri — 3 аккуратных кусочка с рисом и тунцом. Вес 105 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'MAGURO NIGIRI',
            'slug' => 'maguro-nigiri',
            'short_description' => '3 buc. cu orez și ton',
            'full_description' => 'Maguro Nigiri — 3 bucăți delicate cu orez și ton. Greutate 105 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'MAGURO NIGIRI',
            'slug' => 'maguro-nigiri',
            'short_description' => '3 pcs with rice and tuna',
            'full_description' => 'Maguro Nigiri — 3 neat pieces with rice and tuna. Weight 105 g.',
        ]);

        // ========== ТОВАР 4: UNAGHI NIGIRI ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 6, // Nigiri
            'sku' => 'UNAGHI-NIGIRI',
            'price' => 90.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'UNAGHI NIGIRI',
            'slug' => 'unaghi-nigiri',
            'short_description' => '3 шт. с рисом и угрём',
            'full_description' => 'Unaghi Nigiri — 3 аккуратных кусочка с рисом и угрём. Вес 105 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'UNAGHI NIGIRI',
            'slug' => 'unaghi-nigiri',
            'short_description' => '3 buc. cu orez și anghilă',
            'full_description' => 'Unaghi Nigiri — 3 bucăți delicate cu orez și anghilă. Greutate 105 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'UNAGHI NIGIRI',
            'slug' => 'unaghi-nigiri',
            'short_description' => '3 pcs with rice and eel',
            'full_description' => 'Unaghi Nigiri — 3 neat pieces with rice and eel. Weight 105 g.',
        ]);
    }
}

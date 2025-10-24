<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederSashimi extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: SHAKE SASHIMI ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 8, // SASHIMI
            'sku' => 'SHAKE-SASHIMI',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'SHAKE SASHIMI',
            'slug' => 'shake-sashimi',
            'short_description' => '1 шт. лосось, 100 г',
            'full_description' => 'Shake Sashimi — свежайший лосось, нарезанный тонкими ломтиками. Вес 100 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'SHAKE SASHIMI',
            'slug' => 'shake-sashimi',
            'short_description' => '1 buc. somon, 100 g',
            'full_description' => 'Shake Sashimi — somon proaspăt tăiat în felii subțiri. Greutate 100 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'SHAKE SASHIMI',
            'slug' => 'shake-sashimi',
            'short_description' => '1 pc salmon, 100 g',
            'full_description' => 'Shake Sashimi — fresh salmon cut into thin slices. Weight 100 g.',
        ]);

        // ========== ТОВАР 2: MAGURO SASHIMI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 8, // SASHIMI
            'sku' => 'MAGURO-SASHIMI',
            'price' => 130.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'MAGURO SASHIMI',
            'slug' => 'maguro-sashimi',
            'short_description' => '1 шт. тунец, 100 г',
            'full_description' => 'Maguro Sashimi — свежайший тунец, нарезанный тонкими ломтиками. Вес 100 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'MAGURO SASHIMI',
            'slug' => 'maguro-sashimi',
            'short_description' => '1 buc. ton, 100 g',
            'full_description' => 'Maguro Sashimi — ton proaspăt tăiat în felii subțiri. Greutate 100 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'MAGURO SASHIMI',
            'slug' => 'maguro-sashimi',
            'short_description' => '1 pc tuna, 100 g',
            'full_description' => 'Maguro Sashimi — fresh tuna cut into thin slices. Weight 100 g.',
        ]);

        // ========== ТОВАР 3: EBI SASHIMI ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 8, // SASHIMI
            'sku' => 'EBI-SASHIMI',
            'price' => 100.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'EBI SASHIMI',
            'slug' => 'ebi-sashimi',
            'short_description' => '1 шт. креветка, 100 г',
            'full_description' => 'Ebi Sashimi — нежные креветки, поданные в традиционном стиле сашими. Вес 100 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'EBI SASHIMI',
            'slug' => 'ebi-sashimi',
            'short_description' => '1 buc. crevete, 100 g',
            'full_description' => 'Ebi Sashimi — creveți delicați serviți în stil tradițional sashimi. Greutate 100 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'EBI SASHIMI',
            'slug' => 'ebi-sashimi',
            'short_description' => '1 pc shrimp, 100 g',
            'full_description' => 'Ebi Sashimi — tender shrimp served in traditional sashimi style. Weight 100 g.',
        ]);

        // ========== ТОВАР 4: UNAGHI SASHIMI ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 8, // SASHIMI
            'sku' => 'UNAGHI-SASHIMI',
            'price' => 170.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'UNAGHI SASHIMI',
            'slug' => 'unaghi-sashimi',
            'short_description' => '1 шт. угорь, 100 г',
            'full_description' => 'Unaghi Sashimi — сочный угорь, поданный в традиционном стиле сашими. Вес 100 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'UNAGHI SASHIMI',
            'slug' => 'unaghi-sashimi',
            'short_description' => '1 buc. anghilă, 100 g',
            'full_description' => 'Unaghi Sashimi — anghilă suculentă servită în stil tradițional sashimi. Greutate 100 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'UNAGHI SASHIMI',
            'slug' => 'unaghi-sashimi',
            'short_description' => '1 pc eel, 100 g',
            'full_description' => 'Unaghi Sashimi — juicy eel served in traditional sashimi style. Weight 100 g.',
        ]);
    }
}

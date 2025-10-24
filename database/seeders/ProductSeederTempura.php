<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederTempura extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: TORI TEMPURA ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'TORI-TEMPURA',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'TORI TEMPURA',
            'slug' => 'tori-tempura',
            'short_description' => 'Хрустящая темпура с курицей и сыром',
            'full_description' => 'Tori Tempura — аппетитные роллы с рисом, сыром, курицей, кунжутом, унаги и тайским соусом. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'TORI TEMPURA',
            'slug' => 'tori-tempura',
            'short_description' => 'Tempura crocantă cu pui și brânză',
            'full_description' => 'Tori Tempura sunt rulouri delicioase cu orez, brânză, pui, susan, sos unagi și sos thailandez. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'TORI TEMPURA',
            'slug' => 'tori-tempura',
            'short_description' => 'Crispy tempura with chicken and cheese',
            'full_description' => 'Tori Tempura are tasty rolls with rice, cheese, chicken, sesame, unagi and Thai sauce. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 2: SHAKE TEMPURA ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'SHAKE-TEMPURA',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'SHAKE TEMPURA',
            'slug' => 'shake-tempura',
            'short_description' => 'Хрустящая темпура с лососем и сливочным сыром',
            'full_description' => 'Shake Tempura — аппетитные роллы с рисом, лососем, авокадо, тобико, сливочным сыром и панко. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'SHAKE TEMPURA',
            'slug' => 'shake-tempura',
            'short_description' => 'Tempura crocantă cu somon și brânză cremoasă',
            'full_description' => 'Shake Tempura sunt rulouri delicioase cu orez, somon, avocado, tobiko, brânză cremoasă și panko. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'SHAKE TEMPURA',
            'slug' => 'shake-tempura',
            'short_description' => 'Crispy tempura with salmon and cream cheese',
            'full_description' => 'Shake Tempura are tasty rolls with rice, salmon, avocado, tobiko, cream cheese, and panko. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 3: SHAKE FURAI TEMPURA ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'SHAKE-FURAI-TEMPURA',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'SHAKE FURAI TEMPURA',
            'slug' => 'shake-furai-tempura',
            'short_description' => 'Хрустящая темпура с лососем, сливочным сыром и луком',
            'full_description' => 'Shake Furai Tempura — аппетитные роллы с рисом, лососем, авокадо, сливочным сыром, панко и луком. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'SHAKE FURAI TEMPURA',
            'slug' => 'shake-furai-tempura',
            'short_description' => 'Tempura crocantă cu somon, brânză cremoasă și ceapă',
            'full_description' => 'Shake Furai Tempura sunt rulouri delicioase cu orez, somon, avocado, brânză cremoasă, panko și ceapă. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'SHAKE FURAI TEMPURA',
            'slug' => 'shake-furai-tempura',
            'short_description' => 'Crispy tempura with salmon, cream cheese and onion',
            'full_description' => 'Shake Furai Tempura are tasty rolls with rice, salmon, avocado, cream cheese, panko, and onion. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 4: EBI TEMPURA ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'EBI-TEMPURA',
            'price' => 165.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'EBI TEMPURA',
            'slug' => 'ebi-tempura',
            'short_description' => 'Хрустящая темпура с креветкой и сливочным сыром',
            'full_description' => 'Ebi Tempura — аппетитные роллы с рисом, креветкой, авокадо, тобико, сливочным сыром и панко. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'EBI TEMPURA',
            'slug' => 'ebi-tempura',
            'short_description' => 'Tempura crocantă cu creveți și brânză cremoasă',
            'full_description' => 'Ebi Tempura sunt rulouri delicioase cu orez, creveți, avocado, tobiko, brânză cremoasă și panko. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'EBI TEMPURA',
            'slug' => 'ebi-tempura',
            'short_description' => 'Crispy tempura with shrimp and cream cheese',
            'full_description' => 'Ebi Tempura are tasty rolls with rice, shrimp, avocado, tobiko, cream cheese, and panko. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 5: MAGURO TEMPURA ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'MAGURO-TEMPURA',
            'price' => 155.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'MAGURO TEMPURA',
            'slug' => 'maguro-tempura',
            'short_description' => 'Темпура с тунцом, авокадо и сливочным сыром',
            'full_description' => 'Maguro Tempura — аппетитные роллы с рисом, тунцом, авокадо, сливочным сыром и панко. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'MAGURO TEMPURA',
            'slug' => 'maguro-tempura',
            'short_description' => 'Tempura cu ton, avocado și brânză cremoasă',
            'full_description' => 'Maguro Tempura sunt rulouri delicioase cu orez, ton, avocado, brânză cremoasă și panko. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'MAGURO TEMPURA',
            'slug' => 'maguro-tempura',
            'short_description' => 'Tempura with tuna, avocado and cream cheese',
            'full_description' => 'Maguro Tempura are tasty rolls with rice, tuna, avocado, cream cheese, and panko. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 6: UNAGHI TEMPURA ==========
        $product6 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'UNAGHI-TEMPURA',
            'price' => 185.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ru',
            'name' => 'UNAGHI TEMPURA',
            'slug' => 'unaghi-tempura',
            'short_description' => 'Темпура с угрём, авокадо и сливочным сыром',
            'full_description' => 'Unaghi Tempura — вкусные роллы с рисом, угрём, авокадо, тобико, сливочным сыром, панко и унаги соусом. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ro',
            'name' => 'UNAGHI TEMPURA',
            'slug' => 'unaghi-tempura',
            'short_description' => 'Tempura cu anghilă, avocado și brânză cremoasă',
            'full_description' => 'Unaghi Tempura sunt rulouri delicioase cu orez, anghilă, avocado, tobiko, brânză cremoasă, panko și sos unagi. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'en',
            'name' => 'UNAGHI TEMPURA',
            'slug' => 'unaghi-tempura',
            'short_description' => 'Tempura with eel, avocado and cream cheese',
            'full_description' => 'Unaghi Tempura are tasty rolls with rice, eel, avocado, tobiko, cream cheese, panko, and unagi sauce. Weight 340 g. 8 pcs.',
        ]);

        // ========== ТОВАР 7: HOT ROLL TEMPURA ==========
        $product7 = Product::create([
            'brand_id' => 1,
            'category_id' => 4, // TEMPURA
            'sku' => 'HOT-ROLL-TEMPURA',
            'price' => 180.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 7,
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ru',
            'name' => 'HOT ROLL TEMPURA',
            'slug' => 'hot-roll-tempura',
            'short_description' => 'Темпура с лососем, авокадо и панко',
            'full_description' => 'Hot Roll Tempura — горячие роллы с рисом, лососем, авокадо, панко и спайс соусом. Вес 340 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ro',
            'name' => 'HOT ROLL TEMPURA',
            'slug' => 'hot-roll-tempura',
            'short_description' => 'Tempura cu somon, avocado și panko',
            'full_description' => 'Hot Roll Tempura sunt rulouri calde cu orez, somon, avocado, panko și sos spicy. Greutate 340 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'en',
            'name' => 'HOT ROLL TEMPURA',
            'slug' => 'hot-roll-tempura',
            'short_description' => 'Tempura with salmon, avocado and panko',
            'full_description' => 'Hot Roll Tempura are hot rolls with rice, salmon, avocado, panko, and spicy sauce. Weight 340 g. 8 pcs.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederUromaki extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: YASAI UROMAKI ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'YASAI-UROMAKI',
            'price' => 110.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'YASAI UROMAKI',
            'slug' => 'yasai-uromaki',
            'short_description' => 'Нежные овощные урамаки с крем-сыром и авокадо',
            'full_description' => 'Yasai Uromaki — лёгкие и свежие роллы с рисом, кремовым сыром, авокадо, огурцом и кунжутом. Вес 280 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'YASAI UROMAKI',
            'slug' => 'yasai-uromaki',
            'short_description' => 'Uromaki delicate cu legume, brânză cremoasă și avocado',
            'full_description' => 'Yasai Uromaki sunt rulouri ușoare cu orez, brânză cremoasă, avocado, castravete și susan. Greutate 280 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'YASAI UROMAKI',
            'slug' => 'yasai-uromaki',
            'short_description' => 'Delicate vegetable uromaki with cream cheese and avocado',
            'full_description' => 'Yasai Uromaki are light and fresh rolls with rice, cream cheese, avocado, cucumber, and sesame. Weight 280 g. 8 pcs.',
        ]);

        // ========== ТОВАР 2: KAPPA UROMAKI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'KAPPA-UROMAKI',
            'price' => 135.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);
        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'KAPPA UROMAKI',
            'slug' => 'kappa-uromaki',
            'short_description' => 'Крабовые урамаки с авокадо и крем-сыром',
            'full_description' => 'Kappa Uromaki — вкусные роллы с рисом, крабом, крем-сыром, авокадо, огурцом, имбирём, васаби и соевым соусом. Вес 300 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'KAPPA UROMAKI',
            'slug' => 'kappa-uromaki',
            'short_description' => 'Uromaki cu crab, avocado și brânză cremoasă',
            'full_description' => 'Kappa Uromaki sunt rulouri cu orez, crab, brânză cremoasă, avocado, castravete, ghimbir, wasabi și sos de soia. Greutate 300 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'KAPPA UROMAKI',
            'slug' => 'kappa-uromaki',
            'short_description' => 'Crab uromaki with avocado and cream cheese',
            'full_description' => 'Kappa Uromaki are delicious rolls with rice, crab, cream cheese, avocado, cucumber, ginger, wasabi, and soy sauce. Weight 300 g. 8 pcs.',
        ]);

        // ========== ТОВАР 3: MIURA UROMAKI ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'MIURA-UROMAKI',
            'price' => 150.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);
        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'MIURA UROMAKI',
            'slug' => 'miura-uromaki',
            'short_description' => 'Урамаки с лососем, авокадо и майонезом',
            'full_description' => 'Miura Uromaki — роллы с рисом, лососем, авокадо, зелёным луком, майонезом и кунжутом. Вес 280 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'MIURA UROMAKI',
            'slug' => 'miura-uromaki',
            'short_description' => 'Uromaki cu somon, avocado și maioneză',
            'full_description' => 'Miura Uromaki sunt rulouri cu orez, somon, avocado, ceapă verde, maioneză și susan. Greutate 280 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'MIURA UROMAKI',
            'slug' => 'miura-uromaki',
            'short_description' => 'Uromaki with salmon, avocado, and mayonnaise',
            'full_description' => 'Miura Uromaki are rolls with rice, salmon, avocado, green onion, mayonnaise, and sesame. Weight 280 g. 8 pcs.',
        ]);

        // ========== ТОВАР 4: CALIFORNIA BLACK UROMAKI ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'CALIFORNIA-BLACK-UROMAKI',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);
        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'CALIFORNIA BLACK UROMAKI',
            'slug' => 'california-black-uromaki',
            'short_description' => 'Калифорния черная с крабом и авокадо',
            'full_description' => 'California Black Uromaki — роллы с рисом, крабом, авокадо, огурцом, майонезом и кунжутом. Вес 300 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'CALIFORNIA BLACK UROMAKI',
            'slug' => 'california-black-uromaki',
            'short_description' => 'California neagră cu crab și avocado',
            'full_description' => 'California Black Uromaki sunt rulouri cu orez, crab, avocado, castravete, maioneză și susan. Greutate 300 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'CALIFORNIA BLACK UROMAKI',
            'slug' => 'california-black-uromaki',
            'short_description' => 'California black with crab and avocado',
            'full_description' => 'California Black Uromaki are rolls with rice, crab, avocado, cucumber, mayonnaise, and sesame. Weight 300 g. 8 pcs.',
        ]);

        // ========== ТОВАР 5: MAGURO UROMAKI ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'MAGURO-UROMAKI',
            'price' => 150.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);
        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'MAGURO UROMAKI',
            'slug' => 'maguro-uromaki',
            'short_description' => 'Урамаки с тунцом и крем-сыром',
            'full_description' => 'Maguro Uromaki — роллы с рисом, тунцом, крем-сыром и кунжутом. Вес 280 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'MAGURO UROMAKI',
            'slug' => 'maguro-uromaki',
            'short_description' => 'Uromaki cu ton și brânză cremoasă',
            'full_description' => 'Maguro Uromaki sunt rulouri cu orez, ton, brânză cremoasă și susan. Greutate 280 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'MAGURO UROMAKI',
            'slug' => 'maguro-uromaki',
            'short_description' => 'Uromaki with tuna and cream cheese',
            'full_description' => 'Maguro Uromaki are rolls with rice, tuna, cream cheese, and sesame. Weight 280 g. 8 pcs.',
        ]);
// ========== ТОВАР 6 ==========
        $product6 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'SALMON-GRILL-UROMAKI',
            'price' => 155.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 6,
        ]);
        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ru',
            'name' => 'SALMON GRILL UROMAKI',
            'slug' => 'salmon-grill-uromaki',
            'short_description' => 'Роллы с семгой гриль и сыром',
            'full_description' => 'Salmon Grill Uromaki — роллы с рисом, семгой гриль, сыром, огурцом, вакаме и тобико. Вес 300 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ro',
            'name' => 'SALMON GRILL UROMAKI',
            'slug' => 'salmon-grill-uromaki',
            'short_description' => 'Rulouri cu somon la grătar și brânză',
            'full_description' => 'Salmon Grill Uromaki sunt rulouri cu orez, somon la grătar, brânză, castravete, wakame și tobiko. Greutate 300 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'en',
            'name' => 'SALMON GRILL UROMAKI',
            'slug' => 'salmon-grill-uromaki',
            'short_description' => 'Rolls with grilled salmon and cheese',
            'full_description' => 'Salmon Grill Uromaki are rolls with rice, grilled salmon, cheese, cucumber, wakame, and tobiko. Weight 300 g. 8 pcs.',
        ]);

        // ========== ТОВАР 7: SHAKE UROMAKI ==========
        $product7 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'SHAKE-UROMAKI',
            'price' => 150.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 7,
        ]);
        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ru',
            'name' => 'SHAKE UROMAKI',
            'slug' => 'shake-uromaki',
            'short_description' => 'Роллы с лососем и кунжутом',
            'full_description' => 'Shake Uromaki — роллы с рисом, лососем, крем-сыром, кунжутом, имбирём, васаби и соевым соусом. Вес 240 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ro',
            'name' => 'SHAKE UROMAKI',
            'slug' => 'shake-uromaki',
            'short_description' => 'Rulouri cu somon și susan',
            'full_description' => 'Shake Uromaki sunt rulouri cu orez, somon, brânză cremoasă, susan, ghimbir, wasabi și sos de soia. Greutate 240 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'en',
            'name' => 'SHAKE UROMAKI',
            'slug' => 'shake-uromaki',
            'short_description' => 'Rolls with salmon and sesame',
            'full_description' => 'Shake Uromaki are rolls with rice, salmon, cream cheese, sesame, ginger, wasabi, and soy sauce. Weight 240 g. 8 pcs.',
        ]);

        // ========== ТОВАР 8: SALMON CHEESE UROMAKI ==========
        $product8 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'SALMON-CHEESE-UROMAKI',
            'price' => 165.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 8,
        ]);
        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ru',
            'name' => 'SALMON CHEESE UROMAKI',
            'slug' => 'salmon-cheese-uromaki',
            'short_description' => 'Роллы с лососем, сыром и унаги соусом',
            'full_description' => 'Salmon Cheese Uromaki — роллы с рисом, сыром, огурцом, лососем, кунжутом и унаги соусом. Вес 330 г. 9 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ro',
            'name' => 'SALMON CHEESE UROMAKI',
            'slug' => 'salmon-cheese-uromaki',
            'short_description' => 'Rulouri cu somon, brânză și sos unagi',
            'full_description' => 'Salmon Cheese Uromaki sunt rulouri cu orez, brânză, castravete, somon, susan și sos unagi. Greutate 330 g. 9 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'en',
            'name' => 'SALMON CHEESE UROMAKI',
            'slug' => 'salmon-cheese-uromaki',
            'short_description' => 'Rolls with salmon, cheese and unagi sauce',
            'full_description' => 'Salmon Cheese Uromaki are rolls with rice, cheese, cucumber, salmon, sesame, and unagi sauce. Weight 330 g. 9 pcs.',
        ]);

        // ========== ТОВАР 9: EBI UROMAKI ==========
        $product9 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'EBI-UROMAKI',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 9,
        ]);
        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'ru',
            'name' => 'EBI UROMAKI',
            'slug' => 'ebi-uromaki',
            'short_description' => 'Роллы с креветкой и кунжутом',
            'full_description' => 'Ebi Uromaki — роллы с рисом, креветкой, крем-сыром, авокадо, кунжутом, унаги соусом, имбирём, васаби и соевым соусом. Вес 290 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'ro',
            'name' => 'EBI UROMAKI',
            'slug' => 'ebi-uromaki',
            'short_description' => 'Rulouri cu crevete și susan',
            'full_description' => 'Ebi Uromaki sunt rulouri cu orez, crevete, brânză cremoasă, avocado, susan, sos unagi, ghimbir, wasabi și sos de soia. Greutate 290 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'en',
            'name' => 'EBI UROMAKI',
            'slug' => 'ebi-uromaki',
            'short_description' => 'Rolls with shrimp and sesame',
            'full_description' => 'Ebi Uromaki are rolls with rice, shrimp, cream cheese, avocado, sesame, unagi sauce, ginger, wasabi, and soy sauce. Weight 290 g. 8 pcs.',
        ]);

        // ========== ТОВАР 10: PHILADELPHIA CLASSIC UROMAKI ==========
        $product10 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'PHILADELPHIA-CLASSIC-UROMAKI',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 10,
        ]);
        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'ru',
            'name' => 'PHILADELPHIA CLASSIC UROMAKI',
            'slug' => 'philadelphia-clasic-uromaki',
            'short_description' => 'Классические Филадельфия с лососем и крем-сыром',
            'full_description' => 'Philadelphia Classic Uromaki — роллы с рисом, лососем, авокадо, огурцом и крем-сыром. Вес 330 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'ro',
            'name' => 'PHILADELPHIA CLASSIC UROMAKI',
            'slug' => 'philadelphia-clasic-uromaki',
            'short_description' => 'Philadelphia clasică cu somon și brânză cremoasă',
            'full_description' => 'Philadelphia Classic Uromaki sunt rulouri cu orez, somon, avocado, castravete și brânză cremoasă. Greutate 330 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'en',
            'name' => 'PHILADELPHIA CLASSIC UROMAKI',
            'slug' => 'philadelphia-clasic-uromaki',
            'short_description' => 'Classic Philadelphia with salmon and cream cheese',
            'full_description' => 'Philadelphia Classic Uromaki are rolls with rice, salmon, avocado, cucumber, and cream cheese. Weight 330 g. 8 pcs.',
        ]);

        // ========== ТОВАР 11: OKINAWA UROMAKI ==========
        $product11 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'OKINAWA-UROMAKI',
            'price' => 155.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 11,
        ]);
        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'ru',
            'name' => 'OKINAWA UROMAKI',
            'slug' => 'okinawa-uromaki',
            'short_description' => 'Роллы с семгой и авокадо',
            'full_description' => 'Okinawa Uromaki — роллы с семгой, авокадо, огурцом, кунжутом и японским майонезом. Вес 330 г.',
        ]);
        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'ro',
            'name' => 'OKINAWA UROMAKI',
            'slug' => 'okinawa-uromaki',
            'short_description' => 'Rulouri cu somon și avocado',
            'full_description' => 'Okinawa Uromaki sunt rulouri cu somon, avocado, castravete, susan și maioneză japoneză. Greutate 330 g.',
        ]);
        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'en',
            'name' => 'OKINAWA UROMAKI',
            'slug' => 'okinawa-uromaki',
            'short_description' => 'Rolls with salmon and avocado',
            'full_description' => 'Okinawa Uromaki are rolls with salmon, avocado, cucumber, sesame, and Japanese mayonnaise. Weight 330 g.',
        ]);

        // ========== ТОВАР 12: UNAGHI UROMAKI ==========
        $product12 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'UNAGHI-UROMAKI',
            'price' => 155.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 12,
        ]);
        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'ru',
            'name' => 'UNAGHI UROMAKI',
            'slug' => 'unaghi-uromaki',
            'short_description' => 'Роллы с угрём и крем-сыром',
            'full_description' => 'Unaghi Uromaki — роллы с рисом, угрём, авокадо, крем-сыром, соусом унаги и кунжутом. Вес 280 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'ro',
            'name' => 'UNAGHI UROMAKI',
            'slug' => 'unaghi-uromaki',
            'short_description' => 'Rulouri cu anghilă și brânză cremoasă',
            'full_description' => 'Unaghi Uromaki sunt rulouri cu orez, anghilă, avocado, brânză cremoasă, sos unagi și susan. Greutate 280 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'en',
            'name' => 'UNAGHI UROMAKI',
            'slug' => 'unaghi-uromaki',
            'short_description' => 'Rolls with eel and cream cheese',
            'full_description' => 'Unaghi Uromaki are rolls with rice, eel, avocado, cream cheese, unagi sauce, and sesame. Weight 280 g. 8 pcs.',
        ]);

        // ========== ТОВАР 13: WAKAME UROMAKI ==========
        $product13 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'WAKAME-UROMAKI',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 13,
        ]);
        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'ru',
            'name' => 'WAKAME UROMAKI',
            'slug' => 'wakame-uromaki',
            'short_description' => 'Роллы с вакаме, лососем и крем-сыром',
            'full_description' => 'Wakame Uromaki — роллы с рисом, вакаме, лососем, авокадо, крем-сыром и кунжутом. Вес 320 г. 8 шт.',
        ]);
        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'ro',
            'name' => 'WAKAME UROMAKI',
            'slug' => 'wakame-uromaki',
            'short_description' => 'Rulouri cu wakame, somon și brânză cremoasă',
            'full_description' => 'Wakame Uromaki sunt rulouri cu orez, wakame, somon, avocado, brânză cremoasă și susan. Greutate 320 g. 8 buc.',
        ]);
        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'en',
            'name' => 'WAKAME UROMAKI',
            'slug' => 'wakame-uromaki',
            'short_description' => 'Rolls with wakame, salmon and cream cheese',
            'full_description' => 'Wakame Uromaki are rolls with rice, wakame, salmon, avocado, cream cheese, and sesame. Weight 320 g. 8 pcs.',
        ]);

        // ========== ТОВАР 14: PHILADELPHIA CHEESE UROMAKI ==========
        $product14 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'PHILADELPHIA-CHEESE-UROMAKI',
            'price' => 155.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 14,
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'ru',
            'name' => 'PHILADELPHIA CHEESE UROMAKI',
            'slug' => 'philadelphia-cheese',
            'short_description' => 'Роллы с лососем, сыром и тобико',
            'full_description' => 'Philadelphia Cheese Uromaki — роллы с лососем, сыром и тобико. Вес 310 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'ro',
            'name' => 'PHILADELPHIA CHEESE UROMAKI',
            'slug' => 'philadelphia-cheese',
            'short_description' => 'Rulouri cu somon, brânză și tobiko',
            'full_description' => 'Philadelphia Cheese Uromaki sunt rulouri cu somon, brânză și tobiko. Greutate 310 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'en',
            'name' => 'PHILADELPHIA CHEESE UROMAKI',
            'slug' => 'philadelphia-cheese',
            'short_description' => 'Rolls with salmon, cheese and tobiko',
            'full_description' => 'Philadelphia Cheese Uromaki are rolls with salmon, cheese, and tobiko. Weight 310 g. 8 pcs.',
        ]);

        // ========== ТОВАР 15: CALIFORNIA С КРЕВЕТКОЙ UROMAKI ==========
        $product15 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'CALIFORNIA-CLASIC-UROMAKI',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 15,
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'ru',
            'name' => 'CALIFORNIA С КРЕВЕТКОЙ UROMAKI',
            'slug' => 'california-clasic',
            'short_description' => 'Классические роллы с креветкой, авокадо и огурцом',
            'full_description' => 'California с креветкой Uromaki — нежные роллы с рисом, креветками, авокадо, огурцом, майонезом и тобико. Вес 300 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'ro',
            'name' => 'CALIFORNIA С КРЕВЕТКОЙ UROMAKI',
            'slug' => 'california-clasic',
            'short_description' => 'Rulouri clasice cu creveți, avocado și castravete',
            'full_description' => 'California cu creveți Uromaki sunt rulouri delicate cu orez, creveți, avocado, castravete, maioneză și tobiko. Greutate 300 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'en',
            'name' => 'CALIFORNIA WITH SHRIMP UROMAKI',
            'slug' => 'california-clasic',
            'short_description' => 'Classic rolls with shrimp, avocado, and cucumber',
            'full_description' => 'California with shrimp Uromaki are delicate rolls with rice, shrimp, avocado, cucumber, mayonnaise, and tobiko. Weight 300 g. 8 pcs.',
        ]);
        // ========== ТОВАР 16: DRAGON VERDE UROMAKI ==========
        $product16 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'DRAGON-VERDE-UROMAKI',
            'price' => 165.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 16,
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'ru',
            'name' => 'DRAGON VERDE UROMAKI',
            'slug' => 'dragon-verde',
            'short_description' => 'Роллы с лососем, авокадо и соусом унаги',
            'full_description' => 'Dragon Verde Uromaki — вкусные роллы с рисом, авокадо, лососем, тобико, крем-сыром, соусом унаги и кунжутом. Вес 290 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'ro',
            'name' => 'DRAGON VERDE UROMAKI',
            'slug' => 'dragon-verde',
            'short_description' => 'Rulouri cu somon, avocado și sos unagi',
            'full_description' => 'Dragon Verde Uromaki sunt rulouri delicioase cu orez, avocado, somon, tobiko, brânză cremoasă, sos unagi și susan. Greutate 290 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'en',
            'name' => 'DRAGON VERDE UROMAKI',
            'slug' => 'dragon-verde',
            'short_description' => 'Rolls with salmon, avocado, and unagi sauce',
            'full_description' => 'Dragon Verde Uromaki are delicious rolls with rice, avocado, salmon, tobiko, cream cheese, unagi sauce, and sesame. Weight 290 g. 8 pcs.',
        ]);
        // ========== ТОВАР 17: EBI BLACK UROMAKI ==========
        $product17 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'EBI-BLACK-UROMAKI',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 17,
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'ru',
            'name' => 'EBI BLACK UROMAKI',
            'slug' => 'ebi-black-uromaki',
            'short_description' => 'Роллы с креветкой, авокадо и черной икрой тобико',
            'full_description' => 'Ebi Black Uromaki — роллы с рисом, креветкой, крем-сыром, авокадо, черной икрой тобико, острым соусом, имбирём, васаби и соевым соусом. Вес 300 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'ro',
            'name' => 'EBI BLACK UROMAKI',
            'slug' => 'ebi-black-uromaki',
            'short_description' => 'Rulouri cu creveți, avocado și icre negre tobiko',
            'full_description' => 'Ebi Black Uromaki sunt rulouri cu orez, creveți, brânză cremoasă, avocado, icre negre tobiko, sos picant, ghimbir, wasabi și sos de soia. Greutate 300 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'en',
            'name' => 'EBI BLACK UROMAKI',
            'slug' => 'ebi-black-uromaki',
            'short_description' => 'Rolls with shrimp, avocado, and black tobiko',
            'full_description' => 'Ebi Black Uromaki are rolls with rice, shrimp, cream cheese, avocado, black tobiko, spicy sauce, ginger, wasabi, and soy sauce. Weight 300 g. 8 pcs.',
        ]);

        // ========== ТОВАР 18: SHAKE BLACK UROMAKI ==========
        $product18 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'SHAKE-BLACK-UROMAKI',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 18,
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'ru',
            'name' => 'SHAKE BLACK UROMAKI',
            'slug' => 'shake-black-uromaki',
            'short_description' => 'Роллы с лососем и крем-сыром',
            'full_description' => 'Shake Black Uromaki — вкусные роллы с рисом, лососем, крем-сыром и кунжутом. Вес 280 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'ro',
            'name' => 'SHAKE BLACK UROMAKI',
            'slug' => 'shake-black-uromaki',
            'short_description' => 'Rulouri cu somon și brânză cremoasă',
            'full_description' => 'Shake Black Uromaki sunt rulouri delicioase cu orez, somon, brânză cremoasă și susan. Greutate 280 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'en',
            'name' => 'SHAKE BLACK UROMAKI',
            'slug' => 'shake-black-uromaki',
            'short_description' => 'Rolls with salmon and cream cheese',
            'full_description' => 'Shake Black Uromaki are delicious rolls with rice, salmon, cream cheese, and sesame. Weight 280 g. 8 pcs.',
        ]);

        // ========== ТОВАР 19: TAKUMA UROMAKI ==========
        $product19 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'TAKUMA-UROMAKI',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 19,
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'ru',
            'name' => 'TAKUMA UROMAKI',
            'slug' => 'takuma-uromaki',
            'short_description' => 'Роллы с лососем, авокадо и красной икрой',
            'full_description' => 'Takuma Uromaki — вкусные роллы с рисом, лососем, авокадо, крем-сыром, красной икрой тобико, имбирём, васаби и соевым соусом. Вес 300 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'ro',
            'name' => 'TAKUMA UROMAKI',
            'slug' => 'takuma-uromaki',
            'short_description' => 'Rulouri cu somon, avocado și icre roșii',
            'full_description' => 'Takuma Uromaki sunt rulouri delicioase cu orez, somon, avocado, brânză cremoasă, icre roșii tobiko, ghimbir, wasabi și sos de soia. Greutate 300 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'en',
            'name' => 'TAKUMA UROMAKI',
            'slug' => 'takuma-uromaki',
            'short_description' => 'Rolls with salmon, avocado, and red tobiko',
            'full_description' => 'Takuma Uromaki are delicious rolls with rice, salmon, avocado, cream cheese, red tobiko, ginger, wasabi, and soy sauce. Weight 300 g. 8 pcs.',
        ]);

        // ========== ТОВАР 20: OXI UROMAKI ==========
        $product20 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'OXI-UROMAKI',
            'price' => 185.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 20,
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'ru',
            'name' => 'OXI UROMAKI',
            'slug' => 'oxi-uromaki',
            'short_description' => 'Роллы с лососем, креветкой и авокадо',
            'full_description' => 'Oxi Uromaki — сытные роллы с рисом, лососем, креветкой, крем-сыром, авокадо, красной икрой тобико, имбирём, васаби и соевым соусом. Вес 310 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'ro',
            'name' => 'OXI UROMAKI',
            'slug' => 'oxi-uromaki',
            'short_description' => 'Rulouri cu somon, creveți și avocado',
            'full_description' => 'Oxi Uromaki sunt rulouri consistente cu orez, somon, creveți, brânză cremoasă, avocado, icre roșii tobiko, ghimbir, wasabi și sos de soia. Greutate 310 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'en',
            'name' => 'OXI UROMAKI',
            'slug' => 'oxi-uromaki',
            'short_description' => 'Rolls with salmon, shrimp, and avocado',
            'full_description' => 'Oxi Uromaki are hearty rolls with rice, salmon, shrimp, cream cheese, avocado, red tobiko, ginger, wasabi, and soy sauce. Weight 310 g. 8 pcs.',
        ]);

        // ========== ТОВАР 21: AVO UROMAKI ==========
        $product21 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'AVO-UROMAKI',
            'price' => 185.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 21,
        ]);

        ProductTranslation::create([
            'product_id' => $product21->id,
            'language' => 'ru',
            'name' => 'AVO UROMAKI',
            'slug' => 'avo-uromaki',
            'short_description' => 'Роллы с авокадо и семгой',
            'full_description' => 'Avo Uromaki — свежие роллы с рисом, авокадо и семгой. Вес 280 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product21->id,
            'language' => 'ro',
            'name' => 'AVO UROMAKI',
            'slug' => 'avo-uromaki',
            'short_description' => 'Rulouri cu avocado și somon',
            'full_description' => 'Avo Uromaki sunt rulouri proaspete cu orez, avocado și somon. Greutate 280 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product21->id,
            'language' => 'en',
            'name' => 'AVO UROMAKI',
            'slug' => 'avo-uromaki',
            'short_description' => 'Rolls with avocado and salmon',
            'full_description' => 'Avo Uromaki are fresh rolls with rice, avocado, and salmon. Weight 280 g. 8 pcs.',
        ]);

        // ========== ТОВАР 22: RAINBOW UROMAKI ==========
        $product22 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'RAINBOW-UROMAKI',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 22,
        ]);

        ProductTranslation::create([
            'product_id' => $product22->id,
            'language' => 'ru',
            'name' => 'RAINBOW UROMAKI',
            'slug' => 'rainbow-uromaki',
            'short_description' => 'Роллы с креветкой темпура, угрём и лососем',
            'full_description' => 'Rainbow Uromaki — яркие роллы с креветкой темпура, угрём, лососем, авокадо, тунцом и огурцом. Вес 310 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product22->id,
            'language' => 'ro',
            'name' => 'RAINBOW UROMAKI',
            'slug' => 'rainbow-uromaki',
            'short_description' => 'Rulouri cu creveți tempura, anghilă și somon',
            'full_description' => 'Rainbow Uromaki sunt rulouri colorate cu creveți tempura, anghilă, somon, avocado, ton și castravete. Greutate 310 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product22->id,
            'language' => 'en',
            'name' => 'RAINBOW UROMAKI',
            'slug' => 'rainbow-uromaki',
            'short_description' => 'Rolls with tempura shrimp, eel, and salmon',
            'full_description' => 'Rainbow Uromaki are colorful rolls with tempura shrimp, eel, salmon, avocado, tuna, and cucumber. Weight 310 g. 8 pcs.',
        ]);

        // ========== ТОВАР 23: CANADA UROMAKI ==========
        $product23 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'CANADA-UROMAKI',
            'price' => 220.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 23,
        ]);

        ProductTranslation::create([
            'product_id' => $product23->id,
            'language' => 'ru',
            'name' => 'CANADA UROMAKI',
            'slug' => 'canada-uromaki',
            'short_description' => 'Роллы с угрём, лососем и крем-сыром',
            'full_description' => 'Canada Uromaki — насыщенные роллы с рисом, угрём, лососем, авокадо, кремовым сыром, соусом унаги и кунжутом. Вес 290 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product23->id,
            'language' => 'ro',
            'name' => 'CANADA UROMAKI',
            'slug' => 'canada-uromaki',
            'short_description' => 'Rulouri cu anghilă, somon și brânză cremoasă',
            'full_description' => 'Canada Uromaki sunt rulouri consistente cu orez, anghilă, somon, avocado, brânză cremoasă, sos unagi și susan. Greutate 290 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product23->id,
            'language' => 'en',
            'name' => 'CANADA UROMAKI',
            'slug' => 'canada-uromaki',
            'short_description' => 'Rolls with eel, salmon, and cream cheese',
            'full_description' => 'Canada Uromaki are rich rolls with rice, eel, salmon, avocado, cream cheese, unagi sauce, and sesame. Weight 290 g. 8 pcs.',
        ]);

        // ========== ТОВАР 24: RONIN UROMAKI ==========
        $product24 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'RONIN-UROMAKI',
            'price' => 180.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 24,
        ]);

        ProductTranslation::create([
            'product_id' => $product24->id,
            'language' => 'ru',
            'name' => 'RONIN UROMAKI',
            'slug' => 'ronin-uromaki',
            'short_description' => 'Роллы с угрём, авокадо и сыром',
            'full_description' => 'Ronin Uromaki — вкусные роллы с рисом, сыром, авокадо, угрём, тобико и кунжутом. Вес 260 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product24->id,
            'language' => 'ro',
            'name' => 'RONIN UROMAKI',
            'slug' => 'ronin-uromaki',
            'short_description' => 'Rulouri cu anghilă, avocado și brânză',
            'full_description' => 'Ronin Uromaki sunt rulouri delicioase cu orez, brânză, avocado, anghilă, tobiko și susan. Greutate 260 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product24->id,
            'language' => 'en',
            'name' => 'RONIN UROMAKI',
            'slug' => 'ronin-uromaki',
            'short_description' => 'Rolls with eel, avocado, and cheese',
            'full_description' => 'Ronin Uromaki are tasty rolls with rice, cheese, avocado, eel, tobiko, and sesame. Weight 260 g. 8 pcs.',
        ]);

        // ========== ТОВАР 25: SHAKE SPICE UROMAKI ==========
        $product25 = Product::create([
            'brand_id' => 1,
            'category_id' => 2,
            'sku' => 'SHAKE-SPICE-UROMAKI',
            'price' => 205.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 25,
        ]);

        ProductTranslation::create([
            'product_id' => $product25->id,
            'language' => 'ru',
            'name' => 'SHAKE SPICE UROMAKI',
            'slug' => 'shake-spice-uromaki',
            'short_description' => 'Острые роллы с лососем и тобико',
            'full_description' => 'Shake Spice Uromaki — пряные роллы с рисом, лососем, соусом чили, красной икрой тобико, имбирём, васаби и соевым соусом. Вес 270 г. 8 шт.',
        ]);

        ProductTranslation::create([
            'product_id' => $product25->id,
            'language' => 'ro',
            'name' => 'SHAKE SPICE UROMAKI',
            'slug' => 'shake-spice-uromaki',
            'short_description' => 'Rulouri picante cu somon și tobiko',
            'full_description' => 'Shake Spice Uromaki sunt rulouri picante cu orez, somon, sos chili, icre roșii tobiko, ghimbir, wasabi și sos de soia. Greutate 270 g. 8 buc.',
        ]);

        ProductTranslation::create([
            'product_id' => $product25->id,
            'language' => 'en',
            'name' => 'SHAKE SPICE UROMAKI',
            'slug' => 'shake-spice-uromaki',
            'short_description' => 'Spicy rolls with salmon and tobiko',
            'full_description' => 'Shake Spice Uromaki are spicy rolls with rice, salmon, chili sauce, red tobiko, ginger, wasabi, and soy sauce. Weight 270 g. 8 pcs.',
        ]);
    }
}

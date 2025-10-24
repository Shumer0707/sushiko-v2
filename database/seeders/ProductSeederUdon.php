<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederUdon extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: УДОН С ОВОЩАМИ ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 11, // категория "Удон"
            'sku' => 'UDON-CU-LEGUME',
            'price' => 95.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'Удон с овощами',
            'slug' => 'udon-cu-legume',
            'short_description' => 'Вкусный удон с овощами и соусом терияки',
            'full_description' => 'Удон с овощами — удон с цукини, брокколи, луком, морковью, болгарским перцем, стручковой фасолью, грибами, имбирём, чесноком, пекинской капустой, кунжутом и соусом терияки. Вес 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'Udon cu legume',
            'slug' => 'udon-cu-legume',
            'short_description' => 'Udon delicios cu legume și sos teriyaki',
            'full_description' => 'Udon cu legume — udon cu dovlecei, broccoli, ceapă, morcov, ardei gras, fasole păstăi, ciuperci, ghimbir, usturoi, varză chinezească, susan și sos teriyaki. Greutate 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'Udon with vegetables',
            'slug' => 'udon-cu-legume',
            'short_description' => 'Delicious udon with vegetables and teriyaki sauce',
            'full_description' => 'Udon with vegetables — udon with zucchini, broccoli, onion, carrot, bell pepper, green beans, mushrooms, ginger, garlic, Chinese cabbage, sesame, and teriyaki sauce. Weight 400 g.',
        ]);

        // ========== ТОВАР 2: УДОН С КУРИЦЕЙ И ОВОЩАМИ ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 11, // категория "Удон"
            'sku' => 'UDON-CU-PUI-SI-LEGUME',
            'price' => 125.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'Удон с курицей и овощами',
            'slug' => 'udon-cu-pui-si-legume',
            'short_description' => 'Лапша с курицей и овощами в соусе якитори',
            'full_description' => 'Удон с курицей и овощами — пшеничная лапша с филе куриным, болгарским перцем, стручковой фасолью, грибами, пекинской капустой, имбирем, чесноком, луком, морковью, кунжутом и соусом якитори. Вес 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'Udon cu pui și legume',
            'slug' => 'udon-cu-pui-si-legume',
            'short_description' => 'Tăiței cu pui și legume în sos yakitori',
            'full_description' => 'Udon cu pui și legume — tăiței de grâu cu file de pui, ardei gras, fasole păstăi, ciuperci, varză chinezească, ghimbir, usturoi, ceapă, morcov, susan și sos yakitori. Greutate 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'Udon with chicken and vegetables',
            'slug' => 'udon-cu-pui-si-legume',
            'short_description' => 'Wheat noodles with chicken and vegetables in yakitori sauce',
            'full_description' => 'Udon with chicken and vegetables — wheat noodles with chicken fillet, bell pepper, green beans, mushrooms, Chinese cabbage, ginger, garlic, onion, carrot, sesame, and yakitori sauce. Weight 400 g.',
        ]);

        // ========== ТОВАР 3: СОБА С КРЕВЕТКОЙ И КУРИЦЕЙ ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 11, // категория "Удон/Соба"
            'sku' => 'SOBA-CU-CREVETI-SI-PUI',
            'price' => 140.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'Соба с креветкой и курицей',
            'slug' => 'soba-cu-creveti-si-pui',
            'short_description' => 'Гречневая лапша с тигровой креветкой и курицей',
            'full_description' => 'Соба с креветкой и курицей — гречневая лапша с тигровой креветкой, филе куриным, грибами, стручковой фасолью, луком, болгарским перцем, морковью, имбирем, чесноком, пекинской капустой, кунжутом и кисло-сладким соусом чили. Вес 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'Soba cu creveți și pui',
            'slug' => 'soba-cu-creveti-si-pui',
            'short_description' => 'Tăiței de hrișcă cu creveți tigru și pui',
            'full_description' => 'Soba cu creveți și pui — tăiței de hrișcă cu creveți tigru, file de pui, ciuperci, fasole păstăi, ceapă, ardei gras, morcov, ghimbir, usturoi, varză chinezească, susan și sos chili dulce-acrișor. Greutate 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'Soba with shrimp and chicken',
            'slug' => 'soba-cu-creveti-si-pui',
            'short_description' => 'Buckwheat noodles with tiger shrimp and chicken',
            'full_description' => 'Soba with shrimp and chicken — buckwheat noodles with tiger shrimp, chicken fillet, mushrooms, green beans, onion, bell pepper, carrot, ginger, garlic, Chinese cabbage, sesame, and sweet & sour chili sauce. Weight 400 g.',
        ]);

        // ========== ТОВАР 4: СОБА С МОРЕПРОДУКТАМИ ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 11, // категория "Удон/Соба"
            'sku' => 'SOBA-CU-FRUCTE-DE-MARE',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'Соба с морепродуктами',
            'slug' => 'soba-cu-fructe-de-mare',
            'short_description' => 'Гречневая лапша с креветкой, мидиями, кальмаром и осьминогом',
            'full_description' => 'Соба с морепродуктами — гречневая лапша с креветкой, мидиями, кальмаром, осьминогом, болгарским перцем, грибами, морковью, луком, пекинской капустой, стручковой фасолью, имбирём, чесноком, кунжутом и ананасовым соусом. Вес 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'Soba cu fructe de mare',
            'slug' => 'soba-cu-fructe-de-mare',
            'short_description' => 'Tăiței de hrișcă cu creveți, midii, calamari și caracatiță',
            'full_description' => 'Soba cu fructe de mare — tăiței de hrișcă cu creveți, midii, calamari, caracatiță, ardei gras, ciuperci, morcov, ceapă, varză chinezească, fasole păstăi, ghimbir, usturoi, susan și sos de ananas. Greutate 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'Soba with seafood',
            'slug' => 'soba-cu-fructe-de-mare',
            'short_description' => 'Buckwheat noodles with shrimp, mussels, squid and octopus',
            'full_description' => 'Soba with seafood — buckwheat noodles with shrimp, mussels, squid, octopus, bell pepper, mushrooms, carrot, onion, Chinese cabbage, green beans, ginger, garlic, sesame, and pineapple sauce. Weight 400 g.',
        ]);

        // ========== ТОВАР 5: УДОН С ЛОСОСЕМ В ТЕМПУРЕ ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 11, // категория "Удон/Соба"
            'sku' => 'UDON-CU-SOMON-IN-TEMPURA',
            'price' => 145.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'Удон с лососем в темпуре',
            'slug' => 'udon-cu-somon-in-tempura',
            'short_description' => 'Пшеничная лапша с лососем в темпуре и овощами',
            'full_description' => 'Удон с лососем в темпуре — пшеничная лапша с лососем в темпуре, болгарским перцем, пекинской капустой, чесноком, имбирём, морковью, луком, стручковой фасолью, брокколи, грибами, кунжутом и соусом терияки. Вес 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'Udon cu somon în tempura',
            'slug' => 'udon-cu-somon-in-tempura',
            'short_description' => 'Tăiței de grâu cu somon în tempura și legume',
            'full_description' => 'Udon cu somon în tempura — tăiței de grâu cu somon în tempura, ardei gras, varză chinezească, usturoi, ghimbir, morcov, ceapă, fasole păstăi, broccoli, ciuperci, susan și sos teriyaki. Greutate 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'Udon with salmon in tempura',
            'slug' => 'udon-cu-somon-in-tempura',
            'short_description' => 'Wheat noodles with tempura salmon and vegetables',
            'full_description' => 'Udon with salmon in tempura — wheat noodles with tempura salmon, bell pepper, Chinese cabbage, garlic, ginger, carrot, onion, green beans, broccoli, mushrooms, sesame, and teriyaki sauce. Weight 400 g.',
        ]);
    }
}

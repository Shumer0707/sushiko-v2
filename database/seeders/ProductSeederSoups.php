<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederSoups extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: MISO CLASSIC ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 12, // категория супы
            'sku' => 'MISO-CLASSIC',
            'price' => 65.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'Miso classic',
            'slug' => 'miso-classic',
            'short_description' => 'Классический мисо суп с тофу и водорослями',
            'full_description' => 'Miso Classic — нежный мисо бульон с сыром тофу, водорослями Wakame, грибами шиитаки, зелёным луком и кунжутом. Вес 300 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'Miso classic',
            'slug' => 'miso-classic',
            'short_description' => 'Supă miso clasică cu tofu și alge',
            'full_description' => 'Miso Classic — supă miso delicată cu brânză tofu, alge Wakame, ciuperci shiitake, ceapă verde și susan. Greutate 300 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'Miso classic',
            'slug' => 'miso-classic',
            'short_description' => 'Classic miso soup with tofu and seaweed',
            'full_description' => 'Miso Classic — a gentle miso broth with tofu, Wakame seaweed, shiitake mushrooms, green onion, and sesame. Weight 300 g.',
        ]);

        // ========== ТОВАР 2: MISO EBI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 12, // категория супы
            'sku' => 'MISO-EBI',
            'price' => 95.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'Miso Ebi',
            'slug' => 'miso-ebi',
            'short_description' => 'Мисо суп с лососем и креветкой',
            'full_description' => 'Miso Ebi — мисо бульон с сыром тофу, водорослями Wakame, грибами шиитаки, зелёным луком, кунжутом, лососем и креветкой. Вес 300 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'Miso Ebi',
            'slug' => 'miso-ebi',
            'short_description' => 'Supă miso cu somon și creveți',
            'full_description' => 'Miso Ebi — supă miso cu brânză tofu, alge Wakame, ciuperci shiitake, ceapă verde, susan, somon și creveți. Greutate 300 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'Miso Ebi',
            'slug' => 'miso-ebi',
            'short_description' => 'Miso soup with salmon and shrimp',
            'full_description' => 'Miso Ebi — miso broth with tofu, Wakame seaweed, shiitake mushrooms, green onion, sesame, salmon, and shrimp. Weight 300 g.',
        ]);

        // ========== ТОВАР 3: MISO SAKE ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 12, // категория супы
            'sku' => 'MISO-SAKE',
            'price' => 95.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'Miso Sake',
            'slug' => 'miso-sake',
            'short_description' => 'Мисо суп с лососем',
            'full_description' => 'Miso Sake — мисо бульон с сыром тофу, водорослями Wakame, грибами шиитаки, зелёным луком, кунжутом и лососем. Вес 300 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'Miso Sake',
            'slug' => 'miso-sake',
            'short_description' => 'Supă miso cu somon',
            'full_description' => 'Miso Sake — supă miso cu brânză tofu, alge Wakame, ciuperci shiitake, ceapă verde, susan și somon. Greutate 300 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'Miso Sake',
            'slug' => 'miso-sake',
            'short_description' => 'Miso soup with salmon',
            'full_description' => 'Miso Sake — miso broth with tofu, Wakame seaweed, shiitake mushrooms, green onion, sesame, and salmon. Weight 300 g.',
        ]);

        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 12,
            'sku' => 'TOM-YUM-CU-CREVETI',
            'price' => 125.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'Tom Yum с креветками',
            'slug' => 'tom-yum-cu-creveti',
            'short_description' => 'Ароматный тайский суп с креветками',
            'full_description' => 'Tom Yum с креветками — тигровые креветки, куриный бульон, кокосовое молоко, рыбный соус, лайм, перец чили, грибы, черри, петрушка, лук, чеснок, кунжут. Вес 350 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'Tom Yum cu creveți',
            'slug' => 'tom-yum-cu-creveti',
            'short_description' => 'Sup thailandez aromat cu creveți',
            'full_description' => 'Tom Yum cu creveți — creveți tigru, supă de pui, lapte de cocos, sos de pește, lămâie verde, ardei iute, ciuperci, cherry, pătrunjel, ceapă, usturoi, susan. Greutate 350 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'Tom Yum with shrimp',
            'slug' => 'tom-yum-cu-creveti',
            'short_description' => 'Fragrant Thai soup with shrimp',
            'full_description' => 'Tom Yum with shrimp — tiger shrimp, chicken broth, coconut milk, fish sauce, lime, chili pepper, mushrooms, cherry, parsley, onion, garlic, sesame. Weight 350 g.',
        ]);

        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 12,
            'sku' => 'TOM-YUM-CU-FRUCTE-DE-MARE',
            'price' => 135.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'Tom Yum с морепродуктами',
            'slug' => 'tom-yum-cu-fructe-de-mare',
            'short_description' => 'Ароматный тайский суп с морепродуктами',
            'full_description' => 'Tom Yum с морепродуктами — морепродукты (осьминог, мидии, креветки, кальмар), куриный бульон, кокосовое молоко, рыбный соус, лайм, перец чили, грибы, черри, петрушка, лук, чеснок, кунжут. Вес 350 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'Tom Yum cu fructe de mare',
            'slug' => 'tom-yum-cu-fructe-de-mare',
            'short_description' => 'Sup thailandez aromat cu fructe de mare',
            'full_description' => 'Tom Yum cu fructe de mare — fructe de mare (caracatiță, midi, creveți, calmar), supă de pui, lapte de cocos, sos de pește, lămâie verde, ardei iute, ciuperci, cherry, pătrunjel, ceapă, usturoi, susan. Greutate 350 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'Tom Yum with seafood',
            'slug' => 'tom-yum-cu-fructe-de-mare',
            'short_description' => 'Fragrant Thai soup with seafood',
            'full_description' => 'Tom Yum with seafood — seafood (octopus, mussels, shrimp, squid), chicken broth, coconut milk, fish sauce, lime, chili pepper, mushrooms, cherry, parsley, onion, garlic, sesame. Weight 350 g.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederRice extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: ОРЕЗ С ОВОЩАМИ ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 10, // категория "Рис" или как у тебя
            'sku' => 'OREZ-YASAI-TYAHAN-CU-LEGUME',
            'price' => 95.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'Рис с овощами',
            'slug' => 'orez-yasai-tyahan-cu-legume',
            'short_description' => 'Лёгкий рис с разнообразными овощами',
            'full_description' => 'Рис с овощами — вкусное и сытное блюдо с перцем, черри, морковью, луком, грибами, фасолью, кукурузой, чесноком, яйцом, зелёным луком, цукини и имбирём. Заправлено соевым соусом. 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'Orez cu legume',
            'slug' => 'orez-yasai-tyahan-cu-legume',
            'short_description' => 'Orez ușor cu legume variate',
            'full_description' => 'Orez cu legume — un preparat gustos și sățios cu ardei, cherry, morcov, ceapă, ciuperci, fasole, porumb, usturoi, ou, ceapă verde, zucchini și ghimbir. Sos de soia. 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'Rice with vegetables',
            'slug' => 'orez-yasai-tyahan-cu-legume',
            'short_description' => 'Light rice with assorted vegetables',
            'full_description' => 'Rice with vegetables — a tasty and hearty dish with bell pepper, cherry tomato, carrot, onion, mushrooms, beans, corn, garlic, egg, green onion, zucchini, and ginger. Soy sauce. 400 g.',
        ]);

        // ========== ТОВАР 2: ОРЕЗ С ОВОЩАМИ И КУРИЦЕЙ ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 10, // категория "Рис"
            'sku' => 'OREZ-DE-PUI-TORRI-TYAHAN',
            'price' => 125.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'Рис с овощами и курицей',
            'slug' => 'orez-de-pui-torri-tyahan',
            'short_description' => 'Рис с овощами и сочной курицей',
            'full_description' => 'Рис с овощами и курицей — вкусное блюдо с филе куриным, грибами, черри, перцем, морковью, луком, фасолью, кукурузой, яйцом, чесноком, кунжутом, зелёным луком и имбирём. Заправлено соевым соусом. 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'Orez cu legume și pui',
            'slug' => 'orez-de-pui-torri-tyahan',
            'short_description' => 'Orez cu legume și pui gustos',
            'full_description' => 'Orez cu legume și pui — preparat gustos cu file de pui, ciuperci, cherry, ardei, morcov, ceapă, fasole, porumb, ou, usturoi, susan, ceapă verde și ghimbir. Sos de soia. 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'Rice with vegetables and chicken',
            'slug' => 'orez-de-pui-torri-tyahan',
            'short_description' => 'Rice with vegetables and juicy chicken',
            'full_description' => 'Rice with vegetables and chicken — a tasty dish with chicken fillet, mushrooms, cherry tomato, bell pepper, carrot, onion, beans, corn, egg, garlic, sesame, green onion, and ginger. Soy sauce. 400 g.',
        ]);

        // ========== ТОВАР 3: ОРЕЗ С МОРЕПРОДУКТАМИ ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 10, // категория "Рис"
            'sku' => 'OREZ-TUAHAN-CU-FRUCTE-DE-MARE',
            'price' => 150.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'Рис с морепродуктами',
            'slug' => 'orez-tuahan-cu-fructe-de-mare',
            'short_description' => 'Рис с морепродуктами и овощами',
            'full_description' => 'Рис с морепродуктами — вкусное блюдо с морепродуктами, морковью, луком, перцем, грибами, фасолью, кукурузой, яйцом, чесноком, кунжутом, черри, имбирём. Заправлено соевым соусом. 400 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'Orez cu fructe de mare',
            'slug' => 'orez-tuahan-cu-fructe-de-mare',
            'short_description' => 'Orez cu fructe de mare și legume',
            'full_description' => 'Orez cu fructe de mare — preparat gustos cu fructe de mare, morcov, ceapă, ardei, ciuperci, fasole, porumb, ou, usturoi, susan, cherry și ghimbir. Sos de soia. 400 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'Rice with seafood',
            'slug' => 'orez-tuahan-cu-fructe-de-mare',
            'short_description' => 'Rice with seafood and vegetables',
            'full_description' => 'Rice with seafood — a tasty dish with seafood, carrot, onion, bell pepper, mushrooms, beans, corn, egg, garlic, sesame, cherry, and ginger. Soy sauce. 400 g.',
        ]);
    }
}

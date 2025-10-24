<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederBurger extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: BURGER SOMON ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 5, // категория Бургеры
            'sku' => 'BURGER-SOMON',
            'price' => 195.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'Бургер «Сёмга»',
            'slug' => 'burger-somon',
            'short_description' => 'Сочный бургер с семгой, авокадо и кремовой начинкой',
            'full_description' => 'Бургер «Сёмга» — это идеальное сочетание семги, авокадо, огурца, кремовой сыра, икры тобико, японского майонеза, соусов spicy и unagi, кунжута, зелёного лука и хрустящих чипсов из креветок. Вес: 300 г. 1 порция.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'Burger „Somon”',
            'slug' => 'burger-somon',
            'short_description' => 'Burger suculent cu somon, avocado și cremă de brânză',
            'full_description' => 'Burger „Somon” — combinație perfectă de somon, avocado, castravete, brânză cremoasă, icre „Tobiko”, maioneză japoneză, sos „Spicy” și sos „Unagi”, susan, ceapă verde și chipsuri de creveți. Greutate: 300 g. 1 porție.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'Burger „Somon”',
            'slug' => 'burger-somon',
            'short_description' => 'Juicy burger with salmon, avocado and creamy cheese',
            'full_description' => 'Burger „Somon” combines salmon, avocado, cucumber, creamy cheese, Tobiko roe, Japanese mayonnaise, spicy and unagi sauces, sesame, green onion, and crispy shrimp chips. Weight: 300 g. 1 serving.',
        ]);

        // ========== ТОВАР 2: BURGER SOMON-TON ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 5, // категория Бургеры
            'sku' => 'BURGER-SOMON-TON',
            'price' => 195.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'Бургер «Сёмга-Тунец»',
            'slug' => 'burger-somon-ton',
            'short_description' => 'Сочный бургер с семгой, тунцом и кремовой начинкой',
            'full_description' => 'Бургер «Сёмга-Тунец» — это семга, тунец, авокадо, огурец, зелёный лук, кремовая сырная начинка, икра тобико, японский майонез, соусы chili, spicy и unagi, кунжут и чипсы из креветок. Вес: 300 г. 1 порция.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'Burger „Somon-Ton”',
            'slug' => 'burger-somon-ton',
            'short_description' => 'Burger suculent cu somon, ton și cremă de brânză',
            'full_description' => 'Burger „Somon-Ton” — combinație de somon, ton, avocado, castravete, ceapă verde, brânză cremoasă, icre „Tobiko”, maioneză japoneză, sosuri Chili, Spicy și Unagi, susan și chipsuri de creveți. Greutate: 300 g. 1 porție.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'Burger „Somon-Ton”',
            'slug' => 'burger-somon-ton',
            'short_description' => 'Juicy burger with salmon, tuna and creamy cheese',
            'full_description' => 'Burger „Somon-Ton” contains salmon, tuna, avocado, cucumber, green onion, creamy cheese, Tobiko roe, Japanese mayonnaise, Chili, Spicy and Unagi sauces, sesame, and shrimp chips. Weight: 300 g. 1 serving.',
        ]);

        // ========== ТОВАР 3: BURGER CREVETE-CRAB ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 5, // категория Бургеры
            'sku' => 'BURGER-CREVETE-CRAB',
            'price' => 175.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'Бургер «Креветка-Краб»',
            'slug' => 'burger-crevete-crab',
            'short_description' => 'Бургер с креветками, сурими и кремовой начинкой',
            'full_description' => 'Бургер «Креветка-Краб» содержит креветки, крабовое мясо (сурими), кремовую сырную начинку, японский майонез, икру тобико, авокадо, огурец, чипсы из креветок, соусы Spicy и Unagi, кунжут и зелёный лук. Вес: 300 г. 1 порция.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'Burger „Crevete-Crab”',
            'slug' => 'burger-crevete-crab',
            'short_description' => 'Burger cu creveți, surimi și cremă de brânză',
            'full_description' => 'Burger „Crevete-Crab” conține creveți, carne de crab (surimi), brânză cremoasă, maioneză japoneză, icre „Tobiko”, avocado, castravete, chipsuri de creveți, sosuri Spicy și Unagi, susan și ceapă verde. Greutate: 300 g. 1 porție.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'Burger „Crevete-Crab”',
            'slug' => 'burger-crevete-crab',
            'short_description' => 'Burger with shrimp, crab surimi and creamy cheese',
            'full_description' => 'Burger „Crevete-Crab” contains shrimp, crab meat (surimi), creamy cheese, Japanese mayonnaise, Tobiko roe, avocado, cucumber, shrimp chips, Spicy and Unagi sauces, sesame, and green onion. Weight: 300 g. 1 serving.',
        ]);

        // ========== ТОВАР 4: BURGER SOMON LA GRĂTAR ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 5, // категория Бургеры
            'sku' => 'BURGER-SOMON-LA-GRATAR',
            'price' => 170.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'Бургер «Лосось на гриле»',
            'slug' => 'burger-somon-la-gratar',
            'short_description' => 'Бургер с гриль-лососем, авокадо и кремовой начинкой',
            'full_description' => 'Бургер «Лосось на гриле» содержит гриль-лосось, авокадо, огурец, кремовый сыр, соусы Kimchi, Spicy и Unagi, чипсы из креветок, кунжут и зелёный лук. Вес: 300 г. 1 порция.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'Burger „Somon la grătar”',
            'slug' => 'burger-somon-la-gratar',
            'short_description' => 'Burger cu somon la grătar, avocado și brânză cremoasă',
            'full_description' => 'Burger „Somon la grătar” conține somon la grătar, avocado, castravete, brânză cremoasă, sosuri Kimchi, Spicy și Unagi, chipsuri de creveți, susan și ceapă verde. Greutate: 300 g. 1 porție.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'Burger „Somon la grătar”',
            'slug' => 'burger-somon-la-gratar',
            'short_description' => 'Burger with grilled salmon, avocado and creamy cheese',
            'full_description' => 'Burger „Somon la grătar” contains grilled salmon, avocado, cucumber, creamy cheese, Kimchi, Spicy and Unagi sauces, shrimp chips, sesame, and green onion. Weight: 300 g. 1 serving.',
        ]);

        // ========== ТОВАР 5: BURGER PUI TERIYAKI ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 5, // категория Бургеры
            'sku' => 'BURGER-PUI-TERIYAKI',
            'price' => 165.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'Бургер «Курица Терияки»',
            'slug' => 'burger-pui-teriyaki',
            'short_description' => 'Бургер с курицей терияки, чеддером и свежими овощами',
            'full_description' => 'Бургер «Курица Терияки» содержит курицу, сыр Чеддер, салат Айсберг, огурец, зелёный лук, майонез, чипсы из креветок, соусы Spicy и Unagi, кунжут. Вес: 300 г. 1 порция.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'Burger „Pui Teriyaki”',
            'slug' => 'burger-pui-teriyaki',
            'short_description' => 'Burger cu pui teriyaki, brânză Cheddar și legume proaspete',
            'full_description' => 'Burger „Pui Teriyaki” conține pui, brânză Cheddar, salată Iceberg, castravete, ceapă verde, maioneză, chipsuri de creveți, sosuri Spicy și Unagi, susan. Greutate: 300 g. 1 porție.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'Burger „Pui Teriyaki”',
            'slug' => 'burger-pui-teriyaki',
            'short_description' => 'Burger with teriyaki chicken, cheddar cheese and fresh vegetables',
            'full_description' => 'Burger „Pui Teriyaki” contains chicken, Cheddar cheese, Iceberg lettuce, cucumber, green onion, mayonnaise, shrimp chips, Spicy and Unagi sauces, sesame. Weight: 300 g. 1 serving.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederDrink extends Seeder
{
    public function run(): void
    {
        // ========== НАПИТОК 1: OM без газа 0.5L ==========
        $drink1 = Product::create([
            'brand_id' => 1,
            'category_id' => 13, // Категория напитков
            'sku' => 'DRINK-OM-STILL-05',
            'price' => 20.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $drink1->id,
            'language' => 'ru',
            'name' => 'OM без газа 0.5 л',
            'slug' => 'om-bez-gaza-05',
            'short_description' => 'Минеральная вода без газа 0.5 л',
            'full_description' => 'Чистая питьевая вода OM без газа 0.5 л — освежает и утоляет жажду, идеально сочетается с любыми блюдами.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink1->id,
            'language' => 'ro',
            'name' => 'OM fără gaz 0.5 l',
            'slug' => 'om-fara-gaz-05',
            'short_description' => 'Apă minerală plată 0.5 l',
            'full_description' => 'Apă potabilă OM fără gaz 0.5 l — gust pur și răcoritor, perfectă pentru orice masă.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink1->id,
            'language' => 'en',
            'name' => 'OM Still 0.5 L',
            'slug' => 'om-still-05',
            'short_description' => 'Still mineral water 0.5 L',
            'full_description' => 'OM still water 0.5 L — pure and refreshing taste, perfect with any meal.',
        ]);

        // ========== НАПИТОК 2: OM с газом 0.5L ==========
        $drink2 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-OM-SPARKLING-05',
            'price' => 20.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $drink2->id,
            'language' => 'ru',
            'name' => 'OM с газом 0.5 л',
            'slug' => 'om-s-gazom-05',
            'short_description' => 'Минеральная вода с газом 0.5 л',
            'full_description' => 'Искристая минеральная вода OM с газом 0.5 л — освежающая классика для любого случая.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink2->id,
            'language' => 'ro',
            'name' => 'OM carbogazoasă 0.5 l',
            'slug' => 'om-carbogazoasa-05',
            'short_description' => 'Apă minerală carbogazoasă 0.5 l',
            'full_description' => 'Apă minerală carbogazoasă OM 0.5 l — răcoritoare și plăcută, perfectă pentru zilele calde.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink2->id,
            'language' => 'en',
            'name' => 'OM Sparkling 0.5 L',
            'slug' => 'om-sparkling-05',
            'short_description' => 'Sparkling mineral water 0.5 L',
            'full_description' => 'OM sparkling mineral water 0.5 L — crisp and refreshing, great for any occasion.',
        ]);

        // ========== НАПИТОК 3: Coca-Cola Zero 0.33L ==========
        $drink3 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-COLA-ZERO-033',
            'price' => 25.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $drink3->id,
            'language' => 'ru',
            'name' => 'Coca-Cola Zero 0.33 л',
            'slug' => 'coca-cola-zero-033',
            'short_description' => 'Газированный напиток без сахара 0.33 л',
            'full_description' => 'Coca-Cola Zero 0.33 л — любимый вкус без сахара. Отличный выбор для лёгкого ужина.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink3->id,
            'language' => 'ro',
            'name' => 'Coca-Cola Zero 0.33 l',
            'slug' => 'coca-cola-zero-033',
            'short_description' => 'Băutură carbogazoasă fără zahăr 0.33 l',
            'full_description' => 'Coca-Cola Zero 0.33 l — gustul preferat, dar fără zahăr. Perfectă pentru o masă ușoară.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink3->id,
            'language' => 'en',
            'name' => 'Coca-Cola Zero 0.33 L',
            'slug' => 'coca-cola-zero-033',
            'short_description' => 'Sugar-free carbonated drink 0.33 L',
            'full_description' => 'Coca-Cola Zero 0.33 L — the classic taste with zero sugar. Perfect for a light meal.',
        ]);

        // ========== НАПИТОК 4: Coca-Cola 0.33L ==========
        $drink4 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-COLA-033',
            'price' => 25.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $drink4->id,
            'language' => 'ru',
            'name' => 'Coca-Cola 0.33 л',
            'slug' => 'coca-cola-033',
            'short_description' => 'Классическая Coca-Cola 0.33 л',
            'full_description' => 'Coca-Cola 0.33 л — легендарный вкус, который подходит к любому блюду. Подаётся охлаждённой.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink4->id,
            'language' => 'ro',
            'name' => 'Coca-Cola 0.33 l',
            'slug' => 'coca-cola-033',
            'short_description' => 'Coca-Cola clasică 0.33 l',
            'full_description' => 'Coca-Cola 0.33 l — gustul legendar, potrivit pentru orice fel de mâncare. Se servește rece.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink4->id,
            'language' => 'en',
            'name' => 'Coca-Cola 0.33 L',
            'slug' => 'coca-cola-033',
            'short_description' => 'Classic Coca-Cola 0.33 L',
            'full_description' => 'Coca-Cola 0.33 L — the legendary flavor, perfectly served chilled with any dish.',
        ]);

        // ========== НАПИТОК 5: Sprite 0.33L ==========
        $drink5 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-SPRITE-033',
            'price' => 25.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $drink5->id,
            'language' => 'ru',
            'name' => 'Sprite 0.33 л',
            'slug' => 'sprite-033',
            'short_description' => 'Лимонно-лаймовый напиток 0.33 л',
            'full_description' => 'Sprite 0.33 л — освежающий лимонно-лаймовый вкус, идеально подходит к сетам и роллам.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink5->id,
            'language' => 'ro',
            'name' => 'Sprite 0.33 l',
            'slug' => 'sprite-033',
            'short_description' => 'Băutură cu gust de lămâie și lime 0.33 l',
            'full_description' => 'Sprite 0.33 l — gust răcoritor de lămâie și lime, perfect pentru seturi și rulouri.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink5->id,
            'language' => 'en',
            'name' => 'Sprite 0.33 L',
            'slug' => 'sprite-033',
            'short_description' => 'Lemon-lime soft drink 0.33 L',
            'full_description' => 'Sprite 0.33 L — refreshing lemon-lime taste, perfect with rolls and sushi sets.',
        ]);

        // ========== НАПИТОК 6: Fanta 0.33L ==========
        $drink6 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-FANTA-033',
            'price' => 25.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        ProductTranslation::create([
            'product_id' => $drink6->id,
            'language' => 'ru',
            'name' => 'Fanta 0.33 л',
            'slug' => 'fanta-033',
            'short_description' => 'Апельсиновый напиток 0.33 л',
            'full_description' => 'Fanta 0.33 л — яркий апельсиновый вкус, который освежает и поднимает настроение. Подаётся охлаждённой.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink6->id,
            'language' => 'ro',
            'name' => 'Fanta 0.33 l',
            'slug' => 'fanta-033',
            'short_description' => 'Băutură cu gust de portocală 0.33 l',
            'full_description' => 'Fanta 0.33 l — gust de portocală revigorant, perfect pentru orice masă. Se servește rece.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink6->id,
            'language' => 'en',
            'name' => 'Fanta 0.33 L',
            'slug' => 'fanta-033',
            'short_description' => 'Orange soft drink 0.33 L',
            'full_description' => 'Fanta 0.33 L — refreshing orange flavor that perfectly complements your meal. Served chilled.',
        ]);

        // ========== НАПИТОК 7: Fuze Tea 0.5L ==========
        $drink7 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-FUZETEA-05',
            'price' => 35.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 7,
        ]);

        ProductTranslation::create([
            'product_id' => $drink7->id,
            'language' => 'ru',
            'name' => 'Fuze Tea 0.5 л',
            'slug' => 'fuze-tea-05',
            'short_description' => 'Холодный чай в ассортименте 0.5 л',
            'full_description' => 'Fuze Tea 0.5 л — освежающий холодный чай разных вкусов: лимон, персик или зелёный чай. Идеален для летнего настроения.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink7->id,
            'language' => 'ro',
            'name' => 'Fuze Tea 0.5 l',
            'slug' => 'fuze-tea-05',
            'short_description' => 'Ceai rece asortat 0.5 l',
            'full_description' => 'Fuze Tea 0.5 l — ceai rece în diverse arome: lămâie, piersică sau ceai verde. Răcoritor și plăcut.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink7->id,
            'language' => 'en',
            'name' => 'Fuze Tea 0.5 L',
            'slug' => 'fuze-tea-05',
            'short_description' => 'Assorted iced tea 0.5 L',
            'full_description' => 'Fuze Tea 0.5 L — refreshing iced tea available in lemon, peach, or green tea flavors. Perfectly cooling.',
        ]);

        // ========== НАПИТОК 8: Red Bull 0.25L ==========
        $drink8 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-REDBULL-025',
            'price' => 50.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        ProductTranslation::create([
            'product_id' => $drink8->id,
            'language' => 'ru',
            'name' => 'Red Bull 0.25 л',
            'slug' => 'red-bull-025',
            'short_description' => 'Энергетический напиток 0.25 л',
            'full_description' => 'Red Bull 0.25 л — классический энергетик, который придаёт бодрость и энергию. Подаётся охлаждённым.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink8->id,
            'language' => 'ro',
            'name' => 'Red Bull 0.25 l',
            'slug' => 'red-bull-025',
            'short_description' => 'Băutură energizantă 0.25 l',
            'full_description' => 'Red Bull 0.25 l — energizant clasic care oferă vitalitate și energie. Se servește rece.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink8->id,
            'language' => 'en',
            'name' => 'Red Bull 0.25 L',
            'slug' => 'red-bull-025',
            'short_description' => 'Energy drink 0.25 L',
            'full_description' => 'Red Bull 0.25 L — the classic energy drink that gives you energy and focus. Served chilled.',
        ]);

        // ========== НАПИТОК 9: Пиво Oboloni 0.5L ==========
        $drink9 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-OBOLONI-05',
            'price' => 40.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 9,
        ]);

        ProductTranslation::create([
            'product_id' => $drink9->id,
            'language' => 'ru',
            'name' => 'Пиво Oboloni 0.5 л',
            'slug' => 'oboloni-05',
            'short_description' => 'Светлое пиво 0.5 л',
            'full_description' => 'Оболонь 0.5 л — освежающее светлое пиво с мягким вкусом. Идеально к сетам и роллам.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink9->id,
            'language' => 'ro',
            'name' => 'Bere Oboloni 0.5 l',
            'slug' => 'oboloni-05',
            'short_description' => 'Bere blondă 0.5 l',
            'full_description' => 'Oboloni 0.5 l — bere blondă răcoritoare cu gust fin. Perfectă pentru seturi și sushi.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink9->id,
            'language' => 'en',
            'name' => 'Beer Oboloni 0.5 L',
            'slug' => 'oboloni-05',
            'short_description' => 'Light beer 0.5 L',
            'full_description' => 'Oboloni 0.5 L — refreshing light beer with a smooth taste. Perfect with sushi and rolls.',
        ]);

        // ========== НАПИТОК 10: Пиво Estrella 0.33L ==========
        $drink10 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-ESTRELLA-033',
            'price' => 50.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        ProductTranslation::create([
            'product_id' => $drink10->id,
            'language' => 'ru',
            'name' => 'Пиво Estrella 0.33 л',
            'slug' => 'estrella-033',
            'short_description' => 'Премиальное испанское пиво 0.33 л',
            'full_description' => 'Estrella 0.33 л — пиво премиум-класса из Испании, с мягким освежающим вкусом и золотистым цветом.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink10->id,
            'language' => 'ro',
            'name' => 'Bere Estrella 0.33 l',
            'slug' => 'estrella-033',
            'short_description' => 'Bere spaniolă premium 0.33 l',
            'full_description' => 'Estrella 0.33 l — bere premium din Spania, cu gust fin și culoare aurie.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink10->id,
            'language' => 'en',
            'name' => 'Beer Estrella 0.33 L',
            'slug' => 'estrella-033',
            'short_description' => 'Premium Spanish beer 0.33 L',
            'full_description' => 'Estrella 0.33 L — premium beer from Spain with a smooth, refreshing taste and golden hue.',
        ]);

        // ========== НАПИТОК 11: Пиво Budweiser 0.5L ==========
        $drink11 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-BUDWEISER-05',
            'price' => 60.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 11,
        ]);

        ProductTranslation::create([
            'product_id' => $drink11->id,
            'language' => 'ru',
            'name' => 'Пиво Budweiser 0.5 л',
            'slug' => 'budweiser-05',
            'short_description' => 'Чешское пиво 0.5 л',
            'full_description' => 'Budweiser 0.5 л — оригинальное чешское пиво с насыщенным вкусом и лёгкой горчинкой.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink11->id,
            'language' => 'ro',
            'name' => 'Bere Budweiser 0.5 l',
            'slug' => 'budweiser-05',
            'short_description' => 'Bere cehă 0.5 l',
            'full_description' => 'Budweiser 0.5 l — bere originală din Cehia, cu gust bogat și ușor amar.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink11->id,
            'language' => 'en',
            'name' => 'Beer Budweiser 0.5 L',
            'slug' => 'budweiser-05',
            'short_description' => 'Czech beer 0.5 L',
            'full_description' => 'Budweiser 0.5 L — authentic Czech beer with a rich taste and mild bitterness.',
        ]);

        // ========== НАПИТОК 12: Пиво Corona 0.33L ==========
        $drink12 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-CORONA-033',
            'price' => 60.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 12,
        ]);

        ProductTranslation::create([
            'product_id' => $drink12->id,
            'language' => 'ru',
            'name' => 'Пиво Corona 0.33 л',
            'slug' => 'corona-033',
            'short_description' => 'Мексиканское пиво 0.33 л',
            'full_description' => 'Corona 0.33 л — культовое мексиканское пиво с мягким вкусом, идеально под лимон и лёд.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink12->id,
            'language' => 'ro',
            'name' => 'Bere Corona 0.33 l',
            'slug' => 'corona-033',
            'short_description' => 'Bere mexicană 0.33 l',
            'full_description' => 'Corona 0.33 l — bere emblematică din Mexic, cu gust ușor și plăcut. Ideală cu lime și gheață.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink12->id,
            'language' => 'en',
            'name' => 'Beer Corona 0.33 L',
            'slug' => 'corona-033',
            'short_description' => 'Mexican beer 0.33 L',
            'full_description' => 'Corona 0.33 L — iconic Mexican beer with a smooth, light taste. Perfect with lime and ice.',
        ]);

        // ========== НАПИТОК 13: Вино Chateau Vartely 0.75L ==========
        $drink13 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-VARTELY-075',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 13,
        ]);

        ProductTranslation::create([
            'product_id' => $drink13->id,
            'language' => 'ru',
            'name' => 'Вино Chateau Vartely 0.75 л',
            'slug' => 'vin-chateau-vartely-075',
            'short_description' => 'Молдавское вино 0.75 л',
            'full_description' => 'Chateau Vartely 0.75 л — качественное молдавское вино, доступно в красном, белом или розовом варианте.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink13->id,
            'language' => 'ro',
            'name' => 'Vin Chateau Vartely 0.75 l',
            'slug' => 'vin-chateau-vartely-075',
            'short_description' => 'Vin moldovenesc 0.75 l',
            'full_description' => 'Chateau Vartely 0.75 l — vin de calitate din Moldova, disponibil roșu, alb sau roze.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink13->id,
            'language' => 'en',
            'name' => 'Wine Chateau Vartely 0.75 L',
            'slug' => 'wine-chateau-vartely-075',
            'short_description' => 'Moldovan wine 0.75 L',
            'full_description' => 'Chateau Vartely 0.75 L — premium Moldovan wine available in red, white, or rosé.',
        ]);

        // ========== НАПИТОК 14: Вино Cricova 0.75L ==========
        $drink14 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-CRICOVA-075',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 14,
        ]);

        ProductTranslation::create([
            'product_id' => $drink14->id,
            'language' => 'ru',
            'name' => 'Вино Cricova 0.75 л',
            'slug' => 'vin-cricova-075',
            'short_description' => 'Молдавское вино 0.75 л',
            'full_description' => 'Cricova 0.75 л — легендарное молдавское вино, производимое в подземных галереях. Доступно в нескольких сортах.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink14->id,
            'language' => 'ro',
            'name' => 'Vin Cricova 0.75 l',
            'slug' => 'vin-cricova-075',
            'short_description' => 'Vin moldovenesc 0.75 l',
            'full_description' => 'Cricova 0.75 l — vin legendar din Moldova, produs în galerii subterane. Disponibil în mai multe soiuri.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink14->id,
            'language' => 'en',
            'name' => 'Wine Cricova 0.75 L',
            'slug' => 'wine-cricova-075',
            'short_description' => 'Moldovan wine 0.75 L',
            'full_description' => 'Cricova 0.75 L — legendary Moldovan wine aged in underground galleries. Available in various varieties.',
        ]);

        // ========== НАПИТОК 15: Шампанское Apriori 0.75L ==========
        $drink15 = Product::create([
            'brand_id' => 1,
            'category_id' => 13,
            'sku' => 'DRINK-APRIORI-075',
            'price' => 160.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 15,
        ]);

        ProductTranslation::create([
            'product_id' => $drink15->id,
            'language' => 'ru',
            'name' => 'Шампанское Apriori 0.75 л',
            'slug' => 'apriori-075',
            'short_description' => 'Игристое вино 0.75 л',
            'full_description' => 'Apriori 0.75 л — изысканное игристое вино, идеально подходящее для особых случаев и праздничных вечеров.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink15->id,
            'language' => 'ro',
            'name' => 'Vin spumant Apriori 0.75 l',
            'slug' => 'apriori-075',
            'short_description' => 'Vin spumant 0.75 l',
            'full_description' => 'Apriori 0.75 l — vin spumant rafinat, perfect pentru ocazii speciale și seri de sărbătoare.',
        ]);

        ProductTranslation::create([
            'product_id' => $drink15->id,
            'language' => 'en',
            'name' => 'Sparkling wine Apriori 0.75 L',
            'slug' => 'apriori-075',
            'short_description' => 'Sparkling wine 0.75 L',
            'full_description' => 'Apriori 0.75 L — refined sparkling wine, perfect for celebrations and festive evenings.',
        ]);
    }
}

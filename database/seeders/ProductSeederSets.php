<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;

class ProductSeederSets extends Seeder
{
    public function run(): void
    {
        // ========== СЕТ 1: LOVE ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Предполагаю, что сеты это категория 1, поменяй если нужно
            'sku' => 'SET-LOVE',
            'price' => 395.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'Сет LOVE',
            'slug' => 'set-love',
            'short_description' => '24 шт. Philadelphia, California, Hosomaki',
            'full_description' => 'Сет LOVE — идеальный выбор для романтического ужина или встречи с друзьями. В составе три популярных вида роллов: нежная Philadelphia Classic (8 шт.) с кремовым сыром и лососем, классическая California Classic (8 шт.) с огурцом и авокадо, и традиционные Hosomaki Shake (8 шт.) с лососем. Всего 24 штуки вкуснейших роллов. В комплекте имбирь, васаби и соевый соус. Вес: 850 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'Set LOVE',
            'slug' => 'set-love',
            'short_description' => '24 buc. Philadelphia, California, Hosomaki',
            'full_description' => 'Set LOVE — alegerea perfectă pentru o cină romantică sau o întâlnire cu prietenii. Include trei tipuri populare de rulouri: delicata Philadelphia Classic (8 buc.) cu brânză cremoasă și somon, clasica California Classic (8 buc.) cu castravete și avocado, și tradiționalele Hosomaki Shake (8 buc.) cu somon. În total 24 de bucăți de rulouri delicioase. Include ghimbir, wasabi și sos de soia. Greutate: 850 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'LOVE Set',
            'slug' => 'set-love',
            'short_description' => '24 pcs. Philadelphia, California, Hosomaki',
            'full_description' => 'LOVE Set — the perfect choice for a romantic dinner or meeting with friends. Contains three popular types of rolls: delicate Philadelphia Classic (8 pcs.) with cream cheese and salmon, classic California Classic (8 pcs.) with cucumber and avocado, and traditional Hosomaki Shake (8 pcs.) with salmon. A total of 24 pieces of delicious rolls. Includes ginger, wasabi, and soy sauce. Weight: 850 g.',
        ]);

        // ========== СЕТ 2: VOLCANO ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-VOLCANO',
            'price' => 420.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'Сет VOLCANO',
            'slug' => 'set-volcano',
            'short_description' => '26 шт. Vulcan salmon, Ebi crunch, Unaghi big',
            'full_description' => 'Сет VOLCANO — огненная коллекция премиальных роллов для настоящих гурманов! Vulcan salmon roll с нежным лососем, сливочным сыром, свежими огурцом и авокадо, украшенный икрой тобико и кунжутом. Хрустящие Ebi crunch maki с креветкой, салатом айсберг и кунжутом. Изысканные Unaghi big roll с угрем, кремовым сыром, авокадо и кунжутом. Всего 26 штук восхитительных роллов. В комплекте имбирь, васаби и соевый соус. Вес: 910 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'Set VOLCANO',
            'slug' => 'set-volcano',
            'short_description' => '26 buc. Vulcan salmon, Ebi crunch, Unaghi big',
            'full_description' => 'Set VOLCANO — o colecție fierbinte de rulouri premium pentru adevărații gurmanzi! Vulcan salmon roll cu somon delicat, brânză cremoasă, castravete și avocado proaspete, decorat cu icre tobiko și susan. Crocante Ebi crunch maki cu creveți, salată iceberg și susan. Rafinate Unaghi big roll cu anghilă, brânză cremoasă, avocado și susan. În total 26 de bucăți de rulouri extraordinare. Include ghimbir, wasabi și sos de soia. Greutate: 910 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'VOLCANO Set',
            'slug' => 'set-volcano',
            'short_description' => '26 pcs. Vulcan salmon, Ebi crunch, Unaghi big',
            'full_description' => 'VOLCANO Set — a fiery collection of premium rolls for true gourmets! Vulcan salmon roll with tender salmon, cream cheese, fresh cucumber and avocado, topped with tobiko roe and sesame. Crispy Ebi crunch maki with shrimp, iceberg lettuce and sesame. Exquisite Unaghi big roll with eel, cream cheese, avocado and sesame. A total of 26 pieces of amazing rolls. Includes ginger, wasabi, and soy sauce. Weight: 910 g.',
        ]);

        // ========== СЕТ 3: HOT ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-HOT',
            'price' => 385.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'Сет HOT',
            'slug' => 'set-hot',
            'short_description' => '24 шт. Salmon tempura, Tori tempura, Ebi roll',
            'full_description' => 'Сет HOT — взрыв вкуса для любителей горячих роллов! Salmon tempura roll с грилированным лососем, кремовым сыром, свежим огурцом, поливается тайским и унаги соусами, посыпается кунжутом. Tori tempura roll с нежной курицей, сливочным сыром в хрустящей панировке, с тайским и унаги соусами. Классические Ebi roll с креветкой дополняют коллекцию. Всего 24 штуки аппетитных горячих роллов. В комплекте имбирь, васаби и соевый соус. Вес: 870 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'Set HOT',
            'slug' => 'set-hot',
            'short_description' => '24 buc. Salmon tempura, Tori tempura, Ebi roll',
            'full_description' => 'Set HOT — explozie de gust pentru iubitorii de rulouri fierbinți! Salmon tempura roll cu somon la grătar, brânză cremoasă, castravete proaspăt, acoperit cu sos thailandez și unagi, presărat cu susan. Tori tempura roll cu pui delicat, brânză cremoasă în crustă crocantă, cu sosuri thailandez și unagi. Clasicele Ebi roll cu creveți completează colecția. În total 24 de bucăți de rulouri fierbinți apetisante. Include ghimbir, wasabi și sos de soia. Greutate: 870 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'HOT Set',
            'slug' => 'set-hot',
            'short_description' => '24 pcs. Salmon tempura, Tori tempura, Ebi roll',
            'full_description' => 'HOT Set — a flavor explosion for hot roll lovers! Salmon tempura roll with grilled salmon, cream cheese, fresh cucumber, topped with Thai and unagi sauces, sprinkled with sesame. Tori tempura roll with tender chicken, cream cheese in crispy coating, with Thai and unagi sauces. Classic Ebi rolls with shrimp complete the collection. A total of 24 pieces of appetizing hot rolls. Includes ginger, wasabi, and soy sauce. Weight: 870 g.',
        ]);

        // ========== СЕТ 4: SUSHIKO ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-SUSHIKO',
            'price' => 435.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'Сет SUSHIKO',
            'slug' => 'set-sushiko',
            'short_description' => '24 шт. Philadelphia Classic, Dragon Verde, Shake roll',
            'full_description' => 'Сет SUSHIKO — фирменная коллекция лучших роллов нашего ресторана! Включает легендарную Philadelphia Classic (8 шт.) с нежным лососем и кремовым сыром, экзотический Dragon Verde (8 шт.) с авокадо и свежими ингредиентами в стиле дракона, и классический Shake roll (8 шт.) с отборным лососем. Идеальное сочетание традиций и авторских рецептов. Всего 24 штуки премиальных роллов. В комплекте имбирь, васаби и соевый соус. Вес: 900 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'Set SUSHIKO',
            'slug' => 'set-sushiko',
            'short_description' => '24 buc. Philadelphia Classic, Dragon Verde, Shake roll',
            'full_description' => 'Set SUSHIKO — colecția de firmă a celor mai bune rulouri din restaurantul nostru! Include legendara Philadelphia Classic (8 buc.) cu somon delicat și brânză cremoasă, exoticul Dragon Verde (8 buc.) cu avocado și ingrediente proaspete în stil dragon, și clasicul Shake roll (8 buc.) cu somon selectat. Combinația perfectă dintre tradiții și rețete de autor. În total 24 de bucăți de rulouri premium. Include ghimbir, wasabi și sos de soia. Greutate: 900 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'SUSHIKO Set',
            'slug' => 'set-sushiko',
            'short_description' => '24 pcs. Philadelphia Classic, Dragon Verde, Shake roll',
            'full_description' => 'SUSHIKO Set — the signature collection of our restaurant\'s best rolls! Includes the legendary Philadelphia Classic (8 pcs.) with tender salmon and cream cheese, exotic Dragon Verde (8 pcs.) with avocado and fresh dragon-style ingredients, and classic Shake roll (8 pcs.) with selected salmon. The perfect combination of tradition and signature recipes. A total of 24 pieces of premium rolls. Includes ginger, wasabi, and soy sauce. Weight: 900 g.',
        ]);


        // ========== СЕТ 5: HAPPY ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-HAPPY',
            'price' => 465.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'Сет HAPPY',
            'slug' => 'set-happy',
            'short_description' => '25 шт. Salmon cheese, Shake black, Shake tempura',
            'full_description' => 'Сет HAPPY — настоящий праздник вкуса для любителей лосося! Включает сытные Salmon cheese с рисом, кремовым сыром, свежим лососем, хрустящим огурцом и кунжутом. Оригинальные Shake black с лососем в черном кунжуте или нори. Горячие Shake tempura с лососем в хрустящей темпуре. Три разных текстуры и вкуса лосося в одном сете! Всего 25 штук восхитительных роллов. В комплекте имбирь, васаби и соевый соус. Вес: 900 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'Set HAPPY',
            'slug' => 'set-happy',
            'short_description' => '25 buc. Salmon cheese, Shake black, Shake tempura',
            'full_description' => 'Set HAPPY — o adevărată sărbătoare a gustului pentru iubitorii de somon! Include sătuloase Salmon cheese cu orez, brânză cremoasă, somon proaspăt, castravete crocant și susan. Originalele Shake black cu somon în susan negru sau nori. Fierbinții Shake tempura cu somon în tempura crocantă. Trei texturi și gusturi diferite de somon într-un singur set! În total 25 de bucăți de rulouri minunate. Include ghimbir, wasabi și sos de soia. Greutate: 900 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'HAPPY Set',
            'slug' => 'set-happy',
            'short_description' => '25 pcs. Salmon cheese, Shake black, Shake tempura',
            'full_description' => 'HAPPY Set — a true taste celebration for salmon lovers! Includes hearty Salmon cheese with rice, cream cheese, fresh salmon, crispy cucumber and sesame. Original Shake black with salmon in black sesame or nori. Hot Shake tempura with salmon in crispy tempura coating. Three different textures and flavors of salmon in one set! A total of 25 pieces of delightful rolls. Includes ginger, wasabi, and soy sauce. Weight: 900 g.',
        ]);

        // ========== СЕТ 6: IKO ==========
        $product6 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-IKO',
            'price' => 445.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ru',
            'name' => 'Сет IKO',
            'slug' => 'set-iko',
            'short_description' => '24 шт. Philadelphia Classic, California Classic, Shake roll',
            'full_description' => 'Сет IKO — это гармоничное сочетание трёх популярных роллов: Philadelphia Classic, California Classic и Shake roll. Каждый из них создан для идеального баланса вкусов — сливочный сыр, свежий лосось и хрустящие ингредиенты создают насыщенное ощущение разнообразия. В набор также входят традиционные дополнения — имбирь, васаби и соевый соус, чтобы подчеркнуть вкус каждого ролла. Общий вес — 900 грамм, 24 кусочка удовольствия для компании или романтического ужина.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ro',
            'name' => 'Set IKO',
            'slug' => 'set-iko',
            'short_description' => '24 buc. Philadelphia Classic, California Classic, Shake roll',
            'full_description' => 'Setul IKO combină trei rulouri populare: Philadelphia Classic, California Classic și Shake roll. Fiecare rulou este echilibrat perfect între prospețime și cremozitate. Ghimbirul, wasabiul și sosul de soia completează gustul bogat al acestui set. Greutate totală — 900 g, 24 bucăți ideale pentru o cină în doi sau o întâlnire între prieteni.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'en',
            'name' => 'Set IKO',
            'slug' => 'set-iko',
            'short_description' => '24 pcs. Philadelphia Classic, California Classic, Shake roll',
            'full_description' => 'The IKO set combines three beloved rolls: Philadelphia Classic, California Classic, and Shake roll. Each roll is perfectly balanced with creamy cheese, fresh salmon, and crispy texture. Served with ginger, wasabi, and soy sauce to enhance the experience. Total weight — 900 g, 24 pieces of pure sushi delight.',
        ]);
        // ========== СЕТ 7: GURMAN ==========
        $product7 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-GURMAN',
            'price' => 525.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 7,
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ru',
            'name' => 'Сет GURMAN',
            'slug' => 'set-gurman',
            'short_description' => '24 шт. Philadelphia Classic, Canada, California Classic',
            'full_description' => 'Сет GURMAN — выбор настоящего гурмана! Три топовых ролла в одном наборе: сливочная Philadelphia Classic, изысканная Canada с копчёным лососем и свежая California Classic. Всё вместе создаёт идеальное сочетание текстур и вкусов. В комплект входят традиционные дополнения — имбирь, васаби и соевый соус. Общий вес — 920 г, всего 24 кусочка удовольствия.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ro',
            'name' => 'Set GURMAN',
            'slug' => 'set-gurman',
            'short_description' => '24 buc. Philadelphia Classic, Canada, California Classic',
            'full_description' => 'Setul GURMAN este alegerea adevăratului gurmand! Trei rulouri de top într-un singur set: cremosul Philadelphia Classic, rafinatul Canada cu somon afumat și proaspătul California Classic. Combinația perfectă de texturi și arome. Include ghimbir, wasabi și sos de soia. Greutate totală — 920 g, 24 bucăți de plăcere autentică.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'en',
            'name' => 'Set GURMAN',
            'slug' => 'set-gurman',
            'short_description' => '24 pcs. Philadelphia Classic, Canada, California Classic',
            'full_description' => 'Set GURMAN — the choice of true connoisseurs! Three top rolls in one set: creamy Philadelphia Classic, refined Canada with smoked salmon, and refreshing California Classic. A perfect balance of flavors and textures. Includes ginger, wasabi, and soy sauce. Total weight — 920 g, 24 pieces of pure sushi delight.',
        ]);

        // ========== СЕТ 8: CLASSIC ==========
        $product8 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-CLASSIC',
            'price' => 520.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ru',
            'name' => 'Сет CLASSIC',
            'slug' => 'set-classic',
            'short_description' => '33 шт. Tori tempura, Ebi maki, Tuna maki, Philadelphia Classic, Salmon cheese',
            'full_description' => 'Сет CLASSIC — идеальное сочетание популярных роллов для тех, кто любит традиционные вкусы. В набор входят хрустящий Tori tempura с курицей и сыром, нежный Ebi maki с креветкой и тобико, ароматный Tuna maki с тунцом, сливочная Philadelphia Classic и насыщенный Salmon cheese. К каждому сету подаются имбирь, васаби и соевый соус. Общий вес — 1210 г, 33 кусочка удовольствия для всей компании.',
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ro',
            'name' => 'Set CLASSIC',
            'slug' => 'set-classic',
            'short_description' => '33 buc. Tori tempura, Ebi maki, Tuna maki, Philadelphia Classic, Salmon cheese',
            'full_description' => 'Setul CLASSIC — combinația perfectă de rulouri populare pentru iubitorii gusturilor tradiționale. Include crocantul Tori tempura cu pui și brânză, delicatul Ebi maki cu creveți și tobiko, aromatul Tuna maki cu ton, cremosul Philadelphia Classic și bogatul Salmon cheese. Setul este servit cu ghimbir, wasabi și sos de soia. Greutate totală — 1210 g, 33 bucăți de plăcere autentică.',
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'en',
            'name' => 'Set CLASSIC',
            'slug' => 'set-classic',
            'short_description' => '33 pcs. Tori tempura, Ebi maki, Tuna maki, Philadelphia Classic, Salmon cheese',
            'full_description' => 'The CLASSIC set — a perfect mix of popular rolls for those who love traditional sushi flavors. Includes crispy Tori tempura with chicken and cheese, delicate Ebi maki with shrimp and tobiko, flavorful Tuna maki with tuna, creamy Philadelphia Classic, and rich Salmon cheese. Served with ginger, wasabi, and soy sauce. Total weight — 1210 g, 33 pieces of pure delight.',
        ]);

        // ========== СЕТ 9: SPRING ==========
        $product9 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-SPRING',
            'price' => 535.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 9,
        ]);

        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'ru',
            'name' => 'Сет SPRING',
            'slug' => 'set-spring',
            'short_description' => '32 шт. Philadelphia Classic, Avo roll, Shake maki, Ebi maki, Unaghi roll, Yammi roll',
            'full_description' => 'Сет SPRING — яркое весеннее сочетание свежести и вкуса! В набор входят сливочная Philadelphia Classic, лёгкий овощной Avo roll, нежный Shake maki с лососем, пикантный Ebi maki с креветкой, ароматный Unaghi roll с угрём и оригинальный Yammi roll. Каждый ролл подобран для гармонии текстур и вкусов. В комплекте — имбирь, васаби и соевый соус. Общий вес — 1000 г, всего 32 кусочка свежести и удовольствия.',
        ]);

        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'ro',
            'name' => 'Set SPRING',
            'slug' => 'set-spring',
            'short_description' => '32 buc. Philadelphia Classic, Avo roll, Shake maki, Ebi maki, Unaghi roll, Yammi roll',
            'full_description' => 'Setul SPRING — o combinație luminoasă și proaspătă de gusturi! Include Philadelphia Classic cremoasă, Avo roll ușor și vegetal, Shake maki delicat cu somon, Ebi maki picant cu creveți, Unaghi roll aromat cu anghilă și originalul Yammi roll. Fiecare rulou aduce echilibru între texturi și arome. Include ghimbir, wasabi și sos de soia. Greutate totală — 1000 g, 32 bucăți de prospețime și plăcere.',
        ]);

        ProductTranslation::create([
            'product_id' => $product9->id,
            'language' => 'en',
            'name' => 'Set SPRING',
            'slug' => 'set-spring',
            'short_description' => '32 pcs. Philadelphia Classic, Avo roll, Shake maki, Ebi maki, Unaghi roll, Yammi roll',
            'full_description' => 'SPRING set — a bright and refreshing combination of sushi flavors! Includes creamy Philadelphia Classic, light Avo roll, delicate Shake maki with salmon, spicy Ebi maki with shrimp, flavorful Unaghi roll with eel, and the original Yammi roll. Each roll is perfectly balanced in taste and texture. Served with ginger, wasabi, and soy sauce. Total weight — 1000 g, 32 pieces of pure freshness and delight.',
        ]);

        // ========== СЕТ 10: SUNRISE ==========
        $product10 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-SUNRISE',
            'price' => 575.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'ru',
            'name' => 'Сет SUNRISE',
            'slug' => 'set-sunrise',
            'short_description' => '26 шт. Philadelphia Classic, Iceberg roll, Chicken tempura roll, Tropical roll',
            'full_description' => 'Сет SUNRISE — это яркий и насыщенный набор, созданный для настоящих гурманов. В нём сочетаются сливочная Philadelphia Classic, свежий Iceberg roll, аппетитный Chicken tempura roll с курицей терияки, перцем, чеддером и тайским соусом, а также экзотический Tropical roll с лососем, манго и тобико. Каждый ролл раскрывает своё настроение и вкус. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1140 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'ro',
            'name' => 'Set SUNRISE',
            'slug' => 'set-sunrise',
            'short_description' => '26 buc. Philadelphia Classic, Iceberg roll, Chicken tempura roll, Tropical roll',
            'full_description' => 'Setul SUNRISE — un set colorat și gustos, creat pentru adevărații gurmanzi. Conține Philadelphia Classic cremoasă, Iceberg roll proaspăt, Chicken tempura roll apetisant cu pui teriyaki, ardei, brânză cheddar și sos thailandez, precum și Tropical roll exotic cu somon, mango și tobiko. Fiecare rulou are un gust unic și echilibrat. Include ghimbir, wasabi și sos de soia. Greutate totală — 1140 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product10->id,
            'language' => 'en',
            'name' => 'Set SUNRISE',
            'slug' => 'set-sunrise',
            'short_description' => '26 pcs. Philadelphia Classic, Iceberg roll, Chicken tempura roll, Tropical roll',
            'full_description' => 'SUNRISE set — a bright and flavorful collection made for true sushi lovers. It includes creamy Philadelphia Classic, refreshing Iceberg roll, tasty Chicken tempura roll with teriyaki chicken, bell pepper, cheddar cheese and Thai sauce, and exotic Tropical roll with salmon, mango and tobiko. Each roll brings its own mood and flavor. Served with ginger, wasabi, and soy sauce. Total weight — 1140 g.',
        ]);

        // ========== СЕТ 11: PARTY ==========
        $product11 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-PARTY',
            'price' => 545.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 11,
        ]);

        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'ru',
            'name' => 'Сет PARTY',
            'slug' => 'set-party',
            'short_description' => '34 шт. Salmon tempura, Iceberg roll, Okinawa roll',
            'full_description' => 'Сет PARTY — это вкусная и яркая композиция для компании! В набор входят два вида Salmon tempura: один с лососем, сливочным сыром, огурцом и соусом sweet chili, другой — с манго и соусом spicy. Дополняют коллекцию освежающий Iceberg roll с лососем, сыром и айсбергом, а также изысканный Okinawa roll с авокадо, луком и японским майонезом. Идеальный выбор для весёлого вечера. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1120 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'ro',
            'name' => 'Set PARTY',
            'slug' => 'set-party',
            'short_description' => '34 buc. Salmon tempura, Iceberg roll, Okinawa roll',
            'full_description' => 'Setul PARTY — o compoziție gustoasă și colorată pentru prieteni! Include două tipuri de Salmon tempura: unul cu somon, brânză cremoasă, castravete și sos sweet chili, altul cu mango și sos spicy. Completează colecția Iceberg roll proaspăt cu somon, brânză și salată iceberg, precum și Okinawa roll rafinat cu avocado, ceapă și maioneză japoneză. Alegerea perfectă pentru o seară plină de voie bună. Include ghimbir, wasabi și sos de soia. Greutate totală — 1120 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product11->id,
            'language' => 'en',
            'name' => 'Set PARTY',
            'slug' => 'set-party',
            'short_description' => '34 pcs. Salmon tempura, Iceberg roll, Okinawa roll',
            'full_description' => 'PARTY set — a bright and delicious sushi combo for friends! Includes two types of Salmon tempura: one with salmon, cream cheese, cucumber and sweet chili sauce, and another with mango and spicy sauce. Also features refreshing Iceberg roll with salmon, cheese and lettuce, and refined Okinawa roll with avocado, onion and Japanese mayo. The perfect choice for a fun evening. Served with ginger, wasabi, and soy sauce. Total weight — 1120 g.',
        ]);

        // ========== СЕТ 12: MURKA ==========
        $product12 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-MURKA',
            'price' => 625.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 12,
        ]);

        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'ru',
            'name' => 'Сет MURKA',
            'slug' => 'set-murka',
            'short_description' => '32 шт. Philadelphia Classic, Shake tempura, Ebi black, California Classic',
            'full_description' => 'Сет MURKA — насыщенный и сбалансированный набор из четырёх популярных роллов. Включает сливочную Philadelphia Classic, хрустящий Shake tempura с лососем, пикантный Ebi black с креветкой в чёрном кунжуте и свежий California Classic. Вкусное сочетание текстур и ингредиентов, которое оценят все любители суши. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1270 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'ro',
            'name' => 'Set MURKA',
            'slug' => 'set-murka',
            'short_description' => '32 buc. Philadelphia Classic, Shake tempura, Ebi black, California Classic',
            'full_description' => 'Setul MURKA — un set bogat și echilibrat format din patru rulouri populare. Include cremosul Philadelphia Classic, crocantul Shake tempura cu somon, picantul Ebi black cu creveți în susan negru și proaspătul California Classic. O combinație gustoasă de texturi și arome care va fi pe placul tuturor iubitorilor de sushi. Include ghimbir, wasabi și sos de soia. Greutate totală — 1270 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product12->id,
            'language' => 'en',
            'name' => 'Set MURKA',
            'slug' => 'set-murka',
            'short_description' => '32 pcs. Philadelphia Classic, Shake tempura, Ebi black, California Classic',
            'full_description' => 'MURKA set — a rich and well-balanced sushi combo of four popular rolls. Includes creamy Philadelphia Classic, crispy Shake tempura with salmon, spicy Ebi black with shrimp in black sesame, and refreshing California Classic. A delicious mix of textures and flavors for all sushi lovers. Served with ginger, wasabi, and soy sauce. Total weight — 1270 g.',
        ]);

        // ========== СЕТ 13: MANU ==========
        $product13 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-MANU',
            'price' => 635.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 13,
        ]);

        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'ru',
            'name' => 'Сет MANU',
            'slug' => 'set-manu',
            'short_description' => '32 шт. Philadelphia Classic, Canada, Ebi roll, Shake tempura',
            'full_description' => 'Сет MANU — сытный и идеально сбалансированный набор для настоящих ценителей. Включает сливочную Philadelphia Classic, ароматную Canada с копчёным лососем, аппетитный Ebi roll с креветкой и хрустящий Shake tempura с лососем. Отличное сочетание текстур и вкусов. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1250 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'ro',
            'name' => 'Set MANU',
            'slug' => 'set-manu',
            'short_description' => '32 buc. Philadelphia Classic, Canada, Ebi roll, Shake tempura',
            'full_description' => 'Setul MANU — un set sățios și echilibrat, creat pentru adevărații cunoscători. Include Philadelphia Classic cremoasă, Canada aromat cu somon afumat, Ebi roll apetisant cu creveți și Shake tempura crocant cu somon. O combinație perfectă de texturi și arome. Include ghimbir, wasabi și sos de soia. Greutate totală — 1250 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product13->id,
            'language' => 'en',
            'name' => 'Set MANU',
            'slug' => 'set-manu',
            'short_description' => '32 pcs. Philadelphia Classic, Canada, Ebi roll, Shake tempura',
            'full_description' => 'MANU set — a hearty and perfectly balanced combination for true sushi lovers. Includes creamy Philadelphia Classic, flavorful Canada with smoked salmon, tasty Ebi roll with shrimp, and crispy Shake tempura with salmon. A great harmony of textures and flavors. Served with ginger, wasabi, and soy sauce. Total weight — 1250 g.',
        ]);

        // ========== СЕТ 14: YUMMY ==========
        $product14 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-YUMMY',
            'price' => 685.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 14,
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'ru',
            'name' => 'Сет YUMMY',
            'slug' => 'set-yummy',
            'short_description' => '40 шт. Philadelphia, Salmon tempura, Tori tempura, Salmon grill, Ebi roll',
            'full_description' => 'Сет YUMMY — это настоящий праздник для любителей суши! В набор входят нежная Philadelphia, хрустящий Salmon tempura roll, ароматный Tori tempura roll с курицей, сочный Salmon grill roll и классический Ebi roll с креветкой. Идеальное сочетание роллов для большой компании. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1470 г, всего 40 кусочков удовольствия.',
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'ro',
            'name' => 'Set YUMMY',
            'slug' => 'set-yummy',
            'short_description' => '40 buc. Philadelphia, Salmon tempura, Tori tempura, Salmon grill, Ebi roll',
            'full_description' => 'Setul YUMMY — o adevărată sărbătoare pentru iubitorii de sushi! Include Philadelphia delicată, Salmon tempura crocant, Tori tempura aromat cu pui, Salmon grill suculent și clasicul Ebi roll cu creveți. Combinația perfectă de rulouri pentru o companie mare. Include ghimbir, wasabi și sos de soia. Greutate totală — 1470 g, 40 de bucăți de plăcere pură.',
        ]);

        ProductTranslation::create([
            'product_id' => $product14->id,
            'language' => 'en',
            'name' => 'Set YUMMY',
            'slug' => 'set-yummy',
            'short_description' => '40 pcs. Philadelphia, Salmon tempura, Tori tempura, Salmon grill, Ebi roll',
            'full_description' => 'YUMMY set — a true feast for sushi lovers! Includes delicate Philadelphia, crispy Salmon tempura roll, flavorful Tori tempura roll with chicken, juicy Salmon grill roll, and classic Ebi roll with shrimp. The perfect combination of rolls for a big company. Served with ginger, wasabi, and soy sauce. Total weight — 1470 g, 40 pieces of pure enjoyment.',
        ]);

        // ========== СЕТ 15: RAINBOW ==========
        $product15 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-RAINBOW',
            'price' => 595.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 15,
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'ru',
            'name' => 'Сет RAINBOW',
            'slug' => 'set-rainbow',
            'short_description' => '32 шт. Philadelphia cheese, Ronin roll, Rainbow roll, Tempura mix',
            'full_description' => 'Сет RAINBOW — яркий и насыщенный набор для тех, кто любит разнообразие! В составе сливочная Philadelphia cheese, оригинальный Ronin roll с авокадо и угрём, красочный Rainbow roll с тунцом, лососем и креветкой темпура, а также Tempura mix с лососем гриль и креветками. Каждая порция — это новый вкус и настроение. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1260 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'ro',
            'name' => 'Set RAINBOW',
            'slug' => 'set-rainbow',
            'short_description' => '32 buc. Philadelphia cheese, Ronin roll, Rainbow roll, Tempura mix',
            'full_description' => 'Setul RAINBOW — un set viu și echilibrat pentru cei care iubesc varietatea! Include Philadelphia cheese cremoasă, Ronin roll original cu avocado și anghilă, Rainbow roll colorat cu ton, somon și crevete tempura, precum și Tempura mix cu somon la grătar și creveți. Fiecare porție aduce un gust nou și o stare bună. Include ghimbir, wasabi și sos de soia. Greutate totală — 1260 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product15->id,
            'language' => 'en',
            'name' => 'Set RAINBOW',
            'slug' => 'set-rainbow',
            'short_description' => '32 pcs. Philadelphia cheese, Ronin roll, Rainbow roll, Tempura mix',
            'full_description' => 'RAINBOW set — a colorful and rich selection for those who love variety! Includes creamy Philadelphia cheese, original Ronin roll with avocado and eel, vibrant Rainbow roll with tuna, salmon and tempura shrimp, and Tempura mix with grilled salmon and shrimp. Each bite brings a new flavor and mood. Served with ginger, wasabi, and soy sauce. Total weight — 1260 g.',
        ]);

        // ========== СЕТ 16: OSCAR ==========
        $product16 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-OSCAR',
            'price' => 775.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 16,
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'ru',
            'name' => 'Сет OSCAR',
            'slug' => 'set-oscar',
            'short_description' => '40 шт. Philadelphia, Shake tempura, California, Ebi black',
            'full_description' => 'Сет OSCAR — премиальный выбор для ценителей классических роллов. В его состав входят сливочная Philadelphia, два хрустящих Shake tempura с лососем, свежая California и пикантный Ebi black с креветкой в чёрном кунжуте. Насыщенный вкус и идеальный баланс ингредиентов делают этот сет отличным вариантом для большой компании. Общий вес — 1440 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'ro',
            'name' => 'Set OSCAR',
            'slug' => 'set-oscar',
            'short_description' => '40 buc. Philadelphia, Shake tempura, California, Ebi black',
            'full_description' => 'Setul OSCAR — o alegere premium pentru iubitorii de rulouri clasice. Include Philadelphia cremoasă, două Shake tempura crocante cu somon, proaspătul California și picantul Ebi black cu creveți în susan negru. Gust bogat și echilibru perfect de ingrediente — ideal pentru o companie mare. Greutate totală — 1440 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product16->id,
            'language' => 'en',
            'name' => 'Set OSCAR',
            'slug' => 'set-oscar',
            'short_description' => '40 pcs. Philadelphia, Shake tempura, California, Ebi black',
            'full_description' => 'OSCAR set — a premium choice for classic sushi lovers. Includes creamy Philadelphia, two crispy Shake tempura rolls with salmon, fresh California, and spicy Ebi black with shrimp in black sesame. Rich flavor and perfect ingredient balance make this set ideal for sharing. Total weight — 1440 g.',
        ]);

        // ========== СЕТ 17: PREMIUM ==========
        $product17 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-PREMIUM',
            'price' => 845.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 17,
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'ru',
            'name' => 'Сет PREMIUM',
            'slug' => 'set-premium',
            'short_description' => '40 шт. Philadelphia Classic, Shake Spice, Canada, Wakame roll, Dragon Verde',
            'full_description' => 'Сет PREMIUM — это выбор настоящего ценителя японской кухни. В составе пять изысканных роллов: сливочная Philadelphia Classic, пикантный Shake Spice, ароматная Canada с копчёным лососем, освежающий Wakame roll с водорослями вакаме и экзотический Dragon Verde. Каждый ролл — отдельное гастрономическое впечатление. В комплект входят имбирь, васаби и соевый соус. Общий вес — 1500 г.',
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'ro',
            'name' => 'Set PREMIUM',
            'slug' => 'set-premium',
            'short_description' => '40 buc. Philadelphia Classic, Shake Spice, Canada, Wakame roll, Dragon Verde',
            'full_description' => 'Setul PREMIUM — alegerea adevăratului cunoscător al bucătăriei japoneze. Include cinci rulouri rafinate: Philadelphia Classic cremoasă, Shake Spice picant, Canada aromat cu somon afumat, Wakame roll proaspăt cu alge wakame și Dragon Verde exotic. Fiecare rulou este o experiență culinară aparte. Include ghimbir, wasabi și sos de soia. Greutate totală — 1500 g.',
        ]);

        ProductTranslation::create([
            'product_id' => $product17->id,
            'language' => 'en',
            'name' => 'Set PREMIUM',
            'slug' => 'set-premium',
            'short_description' => '40 pcs. Philadelphia Classic, Shake Spice, Canada, Wakame roll, Dragon Verde',
            'full_description' => 'PREMIUM set — the choice of true Japanese cuisine lovers. Includes five exquisite rolls: creamy Philadelphia Classic, spicy Shake Spice, flavorful Canada with smoked salmon, refreshing Wakame roll with seaweed, and exotic Dragon Verde. Each roll is a separate culinary experience. Served with ginger, wasabi, and soy sauce. Total weight — 1500 g.',
        ]);

        // ========== СЕТ 18: CIFRA ==========
        $product18 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-CIFRA',
            'price' => 945.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 18,
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'ru',
            'name' => 'Сет CIFRA',
            'slug' => 'set-cifra',
            'short_description' => '40 шт. 2 California, 2 Shake red, 1 Ebi black',
            'full_description' => 'Сет CIFRA — эксклюзивное предложение с эффектной подачей! В набор входят два ролла California, два ярких Shake red и один Ebi black. Идеальный баланс классических и оригинальных вкусов, созданный для праздничных случаев. Общий вес — 1500 г, 40 кусочков. В стоимость входит оформление (150 лей).',
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'ro',
            'name' => 'Set CIFRA',
            'slug' => 'set-cifra',
            'short_description' => '40 buc. 2 California, 2 Shake red, 1 Ebi black',
            'full_description' => 'Setul CIFRA — o ofertă exclusivă cu o prezentare spectaculoasă! Include două rulouri California, două Shake red și un Ebi black. Un echilibru perfect între gusturile clasice și cele originale, creat pentru ocazii speciale. Greutate totală — 1500 g, 40 bucăți. În preț este inclusă decorarea (150 lei).',
        ]);

        ProductTranslation::create([
            'product_id' => $product18->id,
            'language' => 'en',
            'name' => 'Set CIFRA',
            'slug' => 'set-cifra',
            'short_description' => '40 pcs. 2 California, 2 Shake red, 1 Ebi black',
            'full_description' => 'CIFRA set — an exclusive and beautifully presented selection! Includes two California rolls, two vibrant Shake red rolls, and one Ebi black roll. A perfect harmony of classic and creative flavors, designed for festive occasions. Total weight — 1500 g, 40 pieces. The price includes decoration (150 MDL).',
        ]);

        // ========== СЕТ 19: INIMA 1 ==========
        $product19 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-INIMA-1',
            'price' => 1545.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 19,
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'ru',
            'name' => 'Сет INIMA 1',
            'slug' => 'set-inima-1',
            'short_description' => '72 шт. 4 Philadelphia Classic, 3 California Classic, 2 Dragon Verde',
            'full_description' => 'Сет INIMA 1 — эффектный и щедрый набор для большой компании! В составе четыре сливочных Philadelphia Classic, три свежих California Classic и два экзотических Dragon Verde. Сочетание классических и авторских вкусов делает этот сет универсальным выбором для праздника или романтического ужина. Общий вес — 2800 г, 72 кусочка удовольствия.',
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'ro',
            'name' => 'Set INIMA 1',
            'slug' => 'set-inima-1',
            'short_description' => '72 buc. 4 Philadelphia Classic, 3 California Classic, 2 Dragon Verde',
            'full_description' => 'Setul INIMA 1 — un set spectaculos și generos pentru o companie mare! Include patru Philadelphia Classic cremoase, trei California Classic proaspete și două Dragon Verde exotice. Combinația perfectă între gusturile clasice și cele moderne face din acest set alegerea ideală pentru o seară festivă. Greutate totală — 2800 g, 72 bucăți de plăcere.',
        ]);

        ProductTranslation::create([
            'product_id' => $product19->id,
            'language' => 'en',
            'name' => 'Set INIMA 1',
            'slug' => 'set-inima-1',
            'short_description' => '72 pcs. 4 Philadelphia Classic, 3 California Classic, 2 Dragon Verde',
            'full_description' => 'INIMA 1 set — an impressive and generous selection for a large group! Includes four creamy Philadelphia Classic, three fresh California Classic, and two exotic Dragon Verde rolls. A perfect mix of classic and signature flavors, ideal for celebrations or romantic dinners. Total weight — 2800 g, 72 pieces of pure enjoyment.',
        ]);

        // ========== СЕТ 20: BANZAI ==========
        $product20 = Product::create([
            'brand_id' => 1,
            'category_id' => 1, // Категория сетов
            'sku' => 'SET-BANZAI',
            'price' => 1595.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 20,
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'ru',
            'name' => 'Сет BANZAI',
            'slug' => 'set-banzai',
            'short_description' => '80 шт. Wakame roll, Philadelphia Classic, Canada, Shake Spice, Oxi, Ebi roll, Dragon Verde, Ebi black, Avo roll, Unaghi roll',
            'full_description' => 'Сет BANZAI — грандиозный набор для большой компании и настоящих ценителей японской кухни! В составе десять роллов: освежающий Wakame roll, сливочная Philadelphia Classic, ароматная Canada, пикантный Shake Spice, оригинальный Oxi, нежный Ebi roll, экзотический Dragon Verde, яркий Ebi black, вегетарианский Avo roll и насыщенный Unaghi roll с угрём. Каждый ролл раскрывает свой вкус и настроение. В комплект входят имбирь, васаби и соевый соус. Общий вес — 2960 г, 80 кусочков удовольствия.',
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'ro',
            'name' => 'Set BANZAI',
            'slug' => 'set-banzai',
            'short_description' => '80 buc. Wakame roll, Philadelphia Classic, Canada, Shake Spice, Oxi, Ebi roll, Dragon Verde, Ebi black, Avo roll, Unaghi roll',
            'full_description' => 'Setul BANZAI — un set grandios pentru o companie mare și adevărații iubitori ai bucătăriei japoneze! Include zece rulouri: Wakame roll proaspăt, Philadelphia Classic cremoasă, Canada aromat cu somon afumat, Shake Spice picant, Oxi original, Ebi roll delicat, Dragon Verde exotic, Ebi black colorat, Avo roll vegetarian și Unaghi roll bogat cu anghilă. Fiecare rulou aduce un gust distinct. Include ghimbir, wasabi și sos de soia. Greutate totală — 2960 g, 80 bucăți de plăcere.',
        ]);

        ProductTranslation::create([
            'product_id' => $product20->id,
            'language' => 'en',
            'name' => 'Set BANZAI',
            'slug' => 'set-banzai',
            'short_description' => '80 pcs. Wakame roll, Philadelphia Classic, Canada, Shake Spice, Oxi, Ebi roll, Dragon Verde, Ebi black, Avo roll, Unaghi roll',
            'full_description' => 'BANZAI set — a grand sushi selection for large gatherings and true Japanese cuisine lovers! Includes ten rolls: refreshing Wakame roll, creamy Philadelphia Classic, flavorful Canada, spicy Shake Spice, original Oxi, tender Ebi roll, exotic Dragon Verde, vibrant Ebi black, vegetarian Avo roll, and rich Unaghi roll with eel. Each roll brings a unique flavor and texture. Served with ginger, wasabi, and soy sauce. Total weight — 2960 g, 80 pieces of pure delight.',
        ]);
    }
}

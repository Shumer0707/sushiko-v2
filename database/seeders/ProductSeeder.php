<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем все категории по slug (для связи)
        $categories = $this->getCategories();

        // Получаем бренды по slug
        $brands = $this->getBrands();

        // Массив всех товаров
        $products = $this->getProductsData($categories, $brands);

        // Создаём все товары
        foreach ($products as $productData) {
            $product = Product::create([
                'category_id' => $productData['category_id'],
                'brand_id' => $productData['brand_id'],
                'sku' => $productData['sku'],
                'price' => $productData['price'],
                'currency' => 'MDL',
                'is_active' => true,
                'sort_order' => 0
            ]);

            // Создаём переводы для товара
            foreach ($productData['translations'] as $lang => $translation) {
                ProductTranslation::create([
                    'product_id' => $product->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'slug' => $translation['slug'],
                    'short_description' => $translation['short_description'],
                    'full_description' => $translation['full_description']
                ]);
            }
        }
    }

    /**
     * Получаем все категории из БД
     */
    private function getCategories(): array
    {
        return [
            'sets' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sets'))->first(),
            'uramaki' => Category::whereHas('translations', fn($q) => $q->where('slug', 'uramaki'))->first(),
            'hosomaki' => Category::whereHas('translations', fn($q) => $q->where('slug', 'hosomaki'))->first(),
            'tempura' => Category::whereHas('translations', fn($q) => $q->where('slug', 'tempura'))->first(),
            'burgers' => Category::whereHas('translations', fn($q) => $q->where('slug', 'burgers'))->first(),
            'nigiri' => Category::whereHas('translations', fn($q) => $q->where('slug', 'nigiri'))->first(),
            'gunkan' => Category::whereHas('translations', fn($q) => $q->where('slug', 'gunkan'))->first(),
            'sashimi' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sashimi'))->first(),
            'sunomono' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sunomono'))->first(),
            'rice' => Category::whereHas('translations', fn($q) => $q->where('slug', 'rice'))->first(),
            'noodles' => Category::whereHas('translations', fn($q) => $q->where('slug', 'noodles'))->first(),
            'soup' => Category::whereHas('translations', fn($q) => $q->where('slug', 'soup'))->first(),
            'drinks' => Category::whereHas('translations', fn($q) => $q->where('slug', 'drinks'))->first(),
        ];
    }

    /**
     * Получаем бренды из БД
     */
    private function getBrands(): array
    {
        return [
            'salmon' => Brand::whereHas('translations', fn($q) => $q->where('slug', 'salmon-king'))->first(),
            'ocean' => Brand::whereHas('translations', fn($q) => $q->where('slug', 'ocean-fresh'))->first(),
            'rice' => Brand::whereHas('translations', fn($q) => $q->where('slug', 'rice-master'))->first(),
        ];
    }

    /**
     * Массив всех товаров (60 штук)
     */
    private function getProductsData(array $categories, array $brands): array
    {
        return [
            // ============ SETS / СЕТЫ (5 шт) ============
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'SET001',
                'price' => 250.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СЕТ ДЛЯ ДВОИХ',
                        'slug' => 'set-dlya-dvoih',
                        'short_description' => 'Идеальный набор на двоих',
                        'full_description' => '32 шт: Филадельфия, Калифорния, нигири'
                    ],
                    'ro' => [
                        'name' => 'SET PENTRU DOI',
                        'slug' => 'set-pentru-doi',
                        'short_description' => 'Set ideal pentru doi',
                        'full_description' => '32 buc: Philadelphia, California, nigiri'
                    ],
                    'en' => [
                        'name' => 'SET FOR TWO',
                        'slug' => 'set-for-two',
                        'short_description' => 'Perfect set for two',
                        'full_description' => '32 pcs: Philadelphia, California, nigiri'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SET002',
                'price' => 450.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СЕТ СЕМЕЙНЫЙ',
                        'slug' => 'set-semejnyj',
                        'short_description' => 'Большой набор',
                        'full_description' => '64 шт: ассорти роллов и нигири'
                    ],
                    'ro' => [
                        'name' => 'SET FAMILIAL',
                        'slug' => 'set-familial',
                        'short_description' => 'Set mare',
                        'full_description' => '64 buc: sortiment de roll-uri și nigiri'
                    ],
                    'en' => [
                        'name' => 'FAMILY SET',
                        'slug' => 'family-set',
                        'short_description' => 'Large set',
                        'full_description' => '64 pcs: assorted rolls and nigiri'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'SET003',
                'price' => 180.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СЕТ ВЕГЕТАРИАНСКИЙ',
                        'slug' => 'set-vegetarianskij',
                        'short_description' => 'Без рыбы и мяса',
                        'full_description' => '24 шт: овощные роллы и нигири'
                    ],
                    'ro' => [
                        'name' => 'SET VEGETARIAN',
                        'slug' => 'set-vegetarian',
                        'short_description' => 'Fără pește și carne',
                        'full_description' => '24 buc: roll-uri și nigiri cu legume'
                    ],
                    'en' => [
                        'name' => 'VEGETARIAN SET',
                        'slug' => 'vegetarian-set',
                        'short_description' => 'No fish or meat',
                        'full_description' => '24 pcs: vegetable rolls and nigiri'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SET004',
                'price' => 320.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СЕТ ПРЕМИУМ',
                        'slug' => 'set-premium',
                        'short_description' => 'Лучшие позиции',
                        'full_description' => '40 шт: премиум роллы, сашими, нигири'
                    ],
                    'ro' => [
                        'name' => 'SET PREMIUM',
                        'slug' => 'set-premium',
                        'short_description' => 'Cele mai bune poziții',
                        'full_description' => '40 buc: roll-uri premium, sashimi, nigiri'
                    ],
                    'en' => [
                        'name' => 'PREMIUM SET',
                        'slug' => 'premium-set',
                        'short_description' => 'Best items',
                        'full_description' => '40 pcs: premium rolls, sashimi, nigiri'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'SET005',
                'price' => 220.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СЕТ ТЕМПУРА',
                        'slug' => 'set-tempura',
                        'short_description' => 'Только жареные роллы',
                        'full_description' => '32 шт: ассорти темпура роллов'
                    ],
                    'ro' => [
                        'name' => 'SET TEMPURA',
                        'slug' => 'set-tempura',
                        'short_description' => 'Doar roll-uri prăjite',
                        'full_description' => '32 buc: sortiment de roll-uri tempura'
                    ],
                    'en' => [
                        'name' => 'TEMPURA SET',
                        'slug' => 'tempura-set',
                        'short_description' => 'Only fried rolls',
                        'full_description' => '32 pcs: assorted tempura rolls'
                    ]
                ]
            ],

            // ============ URAMAKI / УРАМАКИ (5 шт) ============
            [
                'category_id' => $categories['uramaki']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'URA001',
                'price' => 85.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ФИЛАДЕЛЬФИЯ',
                        'slug' => 'philadelphia',
                        'short_description' => 'Классический ролл',
                        'full_description' => 'Лосось, сливочный сыр, огурец'
                    ],
                    'ro' => [
                        'name' => 'PHILADELPHIA',
                        'slug' => 'philadelphia',
                        'short_description' => 'Roll clasic',
                        'full_description' => 'Somon, brânză cremă, castravete'
                    ],
                    'en' => [
                        'name' => 'PHILADELPHIA',
                        'slug' => 'philadelphia',
                        'short_description' => 'Classic roll',
                        'full_description' => 'Salmon, cream cheese, cucumber'
                    ]
                ]
            ],
            [
                'category_id' => $categories['uramaki']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'URA002',
                'price' => 80.00,
                'translations' => [
                    'ru' => [
                        'name' => 'КАЛИФОРНИЯ',
                        'slug' => 'california',
                        'short_description' => 'С крабом и икрой',
                        'full_description' => 'Краб, авокадо, огурец, икра масаго'
                    ],
                    'ro' => [
                        'name' => 'CALIFORNIA',
                        'slug' => 'california',
                        'short_description' => 'Cu crab și icre',
                        'full_description' => 'Crab, avocado, castravete, icre masago'
                    ],
                    'en' => [
                        'name' => 'CALIFORNIA',
                        'slug' => 'california',
                        'short_description' => 'With crab and roe',
                        'full_description' => 'Crab, avocado, cucumber, masago roe'
                    ]
                ]
            ],
            [
                'category_id' => $categories['uramaki']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'URA003',
                'price' => 90.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ДРАКОН',
                        'slug' => 'dragon',
                        'short_description' => 'С угрём сверху',
                        'full_description' => 'Креветка, авокадо, угорь сверху'
                    ],
                    'ro' => [
                        'name' => 'DRAGON',
                        'slug' => 'dragon',
                        'short_description' => 'Cu anghilă deasupra',
                        'full_description' => 'Crevetă, avocado, anghilă deasupra'
                    ],
                    'en' => [
                        'name' => 'DRAGON',
                        'slug' => 'dragon',
                        'short_description' => 'With eel on top',
                        'full_description' => 'Shrimp, avocado, eel on top'
                    ]
                ]
            ],
            [
                'category_id' => $categories['uramaki']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'URA004',
                'price' => 88.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РАДУГА',
                        'slug' => 'rainbow',
                        'short_description' => 'Микс рыбы сверху',
                        'full_description' => 'Лосось, тунец, окунь сверху калифорнии'
                    ],
                    'ro' => [
                        'name' => 'CURCUBEU',
                        'slug' => 'curcubeu',
                        'short_description' => 'Mix de pește deasupra',
                        'full_description' => 'Somon, ton, biban deasupra California'
                    ],
                    'en' => [
                        'name' => 'RAINBOW',
                        'slug' => 'rainbow',
                        'short_description' => 'Fish mix on top',
                        'full_description' => 'Salmon, tuna, sea bass on California'
                    ]
                ]
            ],
            [
                'category_id' => $categories['uramaki']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'URA005',
                'price' => 92.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ЛАВА',
                        'slug' => 'lava',
                        'short_description' => 'Острый запечённый ролл',
                        'full_description' => 'Лосось, спайси соус, запечённый сыр'
                    ],
                    'ro' => [
                        'name' => 'LAVA',
                        'slug' => 'lava',
                        'short_description' => 'Roll picant copt',
                        'full_description' => 'Somon, sos spicy, brânză coaptă'
                    ],
                    'en' => [
                        'name' => 'LAVA',
                        'slug' => 'lava',
                        'short_description' => 'Spicy baked roll',
                        'full_description' => 'Salmon, spicy sauce, baked cheese'
                    ]
                ]
            ],

            // ============ HOSOMAKI / ХОСОМАКИ (5 шт) ============
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'HOSO001',
                'price' => 35.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ХОСОМАКИ ЛОСОСЬ',
                        'slug' => 'hosomaki-losos',
                        'short_description' => 'Тонкий ролл с лососем',
                        'full_description' => 'Классический хосомаки с лососем'
                    ],
                    'ro' => [
                        'name' => 'HOSOMAKI SOMON',
                        'slug' => 'hosomaki-somon',
                        'short_description' => 'Roll subțire cu somon',
                        'full_description' => 'Hosomaki clasic cu somon'
                    ],
                    'en' => [
                        'name' => 'SALMON HOSOMAKI',
                        'slug' => 'salmon-hosomaki',
                        'short_description' => 'Thin roll with salmon',
                        'full_description' => 'Classic salmon hosomaki'
                    ]
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'HOSO002',
                'price' => 38.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ХОСОМАКИ ТУНЕЦ',
                        'slug' => 'hosomaki-tunec',
                        'short_description' => 'Тонкий ролл с тунцом',
                        'full_description' => 'Свежий тунец в нори'
                    ],
                    'ro' => [
                        'name' => 'HOSOMAKI TON',
                        'slug' => 'hosomaki-ton',
                        'short_description' => 'Roll subțire cu ton',
                        'full_description' => 'Ton proaspăt în nori'
                    ],
                    'en' => [
                        'name' => 'TUNA HOSOMAKI',
                        'slug' => 'tuna-hosomaki',
                        'short_description' => 'Thin roll with tuna',
                        'full_description' => 'Fresh tuna in nori'
                    ]
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'HOSO003',
                'price' => 30.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ХОСОМАКИ ОГУРЕЦ',
                        'slug' => 'hosomaki-ogurec',
                        'short_description' => 'Вегетарианский ролл',
                        'full_description' => 'Свежий огурец в рисе и нори'
                    ],
                    'ro' => [
                        'name' => 'HOSOMAKI CASTRAVETE',
                        'slug' => 'hosomaki-castravete',
                        'short_description' => 'Roll vegetarian',
                        'full_description' => 'Castravete proaspăt în orez și nori'
                    ],
                    'en' => [
                        'name' => 'CUCUMBER HOSOMAKI',
                        'slug' => 'cucumber-hosomaki',
                        'short_description' => 'Vegetarian roll',
                        'full_description' => 'Fresh cucumber in rice and nori'
                    ]
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'HOSO004',
                'price' => 40.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ХОСОМАКИ УГОРЬ',
                        'slug' => 'hosomaki-ugor',
                        'short_description' => 'Копчёный угорь',
                        'full_description' => 'Угорь с соусом унаги'
                    ],
                    'ro' => [
                        'name' => 'HOSOMAKI ANGHILĂ',
                        'slug' => 'hosomaki-anghila',
                        'short_description' => 'Anghilă afumată',
                        'full_description' => 'Anghilă cu sos unagi'
                    ],
                    'en' => [
                        'name' => 'EEL HOSOMAKI',
                        'slug' => 'eel-hosomaki',
                        'short_description' => 'Smoked eel',
                        'full_description' => 'Eel with unagi sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'HOSO005',
                'price' => 32.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ХОСОМАКИ АВОКАДО',
                        'slug' => 'hosomaki-avokado',
                        'short_description' => 'Вегетарианский с авокадо',
                        'full_description' => 'Спелое авокадо в рисе'
                    ],
                    'ro' => [
                        'name' => 'HOSOMAKI AVOCADO',
                        'slug' => 'hosomaki-avocado',
                        'short_description' => 'Vegetarian cu avocado',
                        'full_description' => 'Avocado copt în orez'
                    ],
                    'en' => [
                        'name' => 'AVOCADO HOSOMAKI',
                        'slug' => 'avocado-hosomaki',
                        'short_description' => 'Vegetarian with avocado',
                        'full_description' => 'Ripe avocado in rice'
                    ]
                ]
            ],

            // ============ TEMPURA / ТЕМПУРА (5 шт) ============
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'TEMP001',
                'price' => 95.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТЕМПУРА ЭБИ',
                        'slug' => 'tempura-ebi',
                        'short_description' => 'Креветка в темпуре',
                        'full_description' => 'Хрустящая креветка, авокадо, спайси соус'
                    ],
                    'ro' => [
                        'name' => 'TEMPURA EBI',
                        'slug' => 'tempura-ebi',
                        'short_description' => 'Crevetă în tempura',
                        'full_description' => 'Crevetă crocantă, avocado, sos spicy'
                    ],
                    'en' => [
                        'name' => 'EBI TEMPURA',
                        'slug' => 'ebi-tempura',
                        'short_description' => 'Shrimp tempura',
                        'full_description' => 'Crispy shrimp, avocado, spicy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'TEMP002',
                'price' => 90.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТЕМПУРА ЛОСОСЬ',
                        'slug' => 'tempura-salmon',
                        'short_description' => 'Лосось в темпуре',
                        'full_description' => 'Жареный лосось, огурец, соус унаги'
                    ],
                    'ro' => [
                        'name' => 'TEMPURA SOMON',
                        'slug' => 'tempura-somon',
                        'short_description' => 'Somon în tempura',
                        'full_description' => 'Somon prăjit, castravete, sos unagi'
                    ],
                    'en' => [
                        'name' => 'SALMON TEMPURA',
                        'slug' => 'salmon-tempura',
                        'short_description' => 'Salmon tempura',
                        'full_description' => 'Fried salmon, cucumber, unagi sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'TEMP003',
                'price' => 85.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТЕМПУРА ОВОЩИ',
                        'slug' => 'tempura-vegetables',
                        'short_description' => 'Вегетарианский',
                        'full_description' => 'Баклажан, тыква, перец в темпуре'
                    ],
                    'ro' => [
                        'name' => 'TEMPURA LEGUME',
                        'slug' => 'tempura-legume',
                        'short_description' => 'Vegetarian',
                        'full_description' => 'Vânătă, dovleac, ardei în tempura'
                    ],
                    'en' => [
                        'name' => 'VEGETABLE TEMPURA',
                        'slug' => 'vegetable-tempura',
                        'short_description' => 'Vegetarian',
                        'full_description' => 'Eggplant, pumpkin, pepper in tempura'
                    ]
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'TEMP004',
                'price' => 98.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТЕМПУРА МИКС',
                        'slug' => 'tempura-mix',
                        'short_description' => 'Креветка и рыба',
                        'full_description' => 'Креветка, лосось, авокадо в темпуре'
                    ],
                    'ro' => [
                        'name' => 'TEMPURA MIX',
                        'slug' => 'tempura-mix',
                        'short_description' => 'Crevetă și pește',
                        'full_description' => 'Crevetă, somon, avocado în tempura'
                    ],
                    'en' => [
                        'name' => 'MIX TEMPURA',
                        'slug' => 'mix-tempura',
                        'short_description' => 'Shrimp and fish',
                        'full_description' => 'Shrimp, salmon, avocado in tempura'
                    ]
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'TEMP005',
                'price' => 92.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТЕМПУРА СПАЙСИ',
                        'slug' => 'tempura-spicy',
                        'short_description' => 'Острый жареный ролл',
                        'full_description' => 'Тунец, перец чили, спайси майонез'
                    ],
                    'ro' => [
                        'name' => 'TEMPURA SPICY',
                        'slug' => 'tempura-spicy',
                        'short_description' => 'Roll picant prăjit',
                        'full_description' => 'Ton, ardei chili, maioneză spicy'
                    ],
                    'en' => [
                        'name' => 'SPICY TEMPURA',
                        'slug' => 'spicy-tempura',
                        'short_description' => 'Spicy fried roll',
                        'full_description' => 'Tuna, chili pepper, spicy mayo'
                    ]
                ]
            ],

            // ============ BURGERS / БУРГЕРЫ (5 шт) ============
            [
                'category_id' => $categories['burgers']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'BURG001',
                'price' => 65.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИСОВЫЙ БУРГЕР ЛОСОСЬ',
                        'slug' => 'rice-burger-salmon',
                        'short_description' => 'Лосось между рисовыми булками',
                        'full_description' => 'Жареный лосось, авокадо, салат между рисом'
                    ],
                    'ro' => [
                        'name' => 'BURGER CU OREZ SOMON',
                        'slug' => 'burger-orez-somon',
                        'short_description' => 'Somon între chifle de orez',
                        'full_description' => 'Somon prăjit, avocado, salată între orez'
                    ],
                    'en' => [
                        'name' => 'RICE BURGER SALMON',
                        'slug' => 'rice-burger-salmon',
                        'short_description' => 'Salmon between rice buns',
                        'full_description' => 'Fried salmon, avocado, lettuce between rice'
                    ]
                ]
            ],
            [
                'category_id' => $categories['burgers']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'BURG002',
                'price' => 70.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИСОВЫЙ БУРГЕР КРЕВЕТКА',
                        'slug' => 'rice-burger-shrimp',
                        'short_description' => 'Креветка в темпуре',
                        'full_description' => 'Креветка темпура, спайси соус, огурец'
                    ],
                    'ro' => [
                        'name' => 'BURGER CU OREZ CREVETĂ',
                        'slug' => 'burger-orez-creveta',
                        'short_description' => 'Crevetă în tempura',
                        'full_description' => 'Crevetă tempura, sos spicy, castravete'
                    ],
                    'en' => [
                        'name' => 'RICE BURGER SHRIMP',
                        'slug' => 'rice-burger-shrimp',
                        'short_description' => 'Tempura shrimp',
                        'full_description' => 'Tempura shrimp, spicy sauce, cucumber'
                    ]
                ]
            ],
            [
                'category_id' => $categories['burgers']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'BURG003',
                'price' => 68.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИСОВЫЙ БУРГЕР УГОРЬ',
                        'slug' => 'rice-burger-eel',
                        'short_description' => 'Копчёный угорь унаги',
                        'full_description' => 'Угорь, соус унаги, огурец, кунжут'
                    ],
                    'ro' => [
                        'name' => 'BURGER CU OREZ ANGHILĂ',
                        'slug' => 'burger-orez-anghila',
                        'short_description' => 'Anghilă afumată unagi',
                        'full_description' => 'Anghilă, sos unagi, castravete, susan'
                    ],
                    'en' => [
                        'name' => 'RICE BURGER EEL',
                        'slug' => 'rice-burger-eel',
                        'short_description' => 'Smoked unagi eel',
                        'full_description' => 'Eel, unagi sauce, cucumber, sesame'
                    ]
                ]
            ],
            [
                'category_id' => $categories['burgers']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'BURG004',
                'price' => 60.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИСОВЫЙ БУРГЕР ВЕГЕТАРИАНСКИЙ',
                        'slug' => 'rice-burger-vegetarian',
                        'short_description' => 'Овощная начинка',
                        'full_description' => 'Авокадо, огурец, салат, томат, спайси соус'
                    ],
                    'ro' => [
                        'name' => 'BURGER CU OREZ VEGETARIAN',
                        'slug' => 'burger-orez-vegetarian',
                        'short_description' => 'Umplutură cu legume',
                        'full_description' => 'Avocado, castravete, salată, roșie, sos spicy'
                    ],
                    'en' => [
                        'name' => 'RICE BURGER VEGETARIAN',
                        'slug' => 'rice-burger-vegetarian',
                        'short_description' => 'Vegetable filling',
                        'full_description' => 'Avocado, cucumber, lettuce, tomato, spicy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['burgers']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'BURG005',
                'price' => 75.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИСОВЫЙ БУРГЕР ТУНЕЦ',
                        'slug' => 'rice-burger-tuna',
                        'short_description' => 'Острый тунец',
                        'full_description' => 'Тунец, спайси майонез, авокадо, чука'
                    ],
                    'ro' => [
                        'name' => 'BURGER CU OREZ TON',
                        'slug' => 'burger-orez-ton',
                        'short_description' => 'Ton picant',
                        'full_description' => 'Ton, maioneză spicy, avocado, chuka'
                    ],
                    'en' => [
                        'name' => 'RICE BURGER TUNA',
                        'slug' => 'rice-burger-tuna',
                        'short_description' => 'Spicy tuna',
                        'full_description' => 'Tuna, spicy mayo, avocado, chuka'
                    ]
                ]
            ],
            // ============ NIGIRI / НИГИРИ (5 шт) ============
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'NIGIRI001',
                'price' => 45.00,
                'translations' => [
                    'ru' => [
                        'name' => 'НИГИРИ ЛОСОСЬ',
                        'slug' => 'nigiri-losos',
                        'short_description' => 'Классические нигири с лососем',
                        'full_description' => 'Свежий лосось на рисовой подушке'
                    ],
                    'ro' => [
                        'name' => 'NIGIRI SOMON',
                        'slug' => 'nigiri-somon',
                        'short_description' => 'Nigiri clasic cu somon',
                        'full_description' => 'Somon proaspăt pe pernuță de orez'
                    ],
                    'en' => [
                        'name' => 'SALMON NIGIRI',
                        'slug' => 'salmon-nigiri',
                        'short_description' => 'Classic salmon nigiri',
                        'full_description' => 'Fresh salmon on rice pillow'
                    ]
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'NIGIRI002',
                'price' => 50.00,
                'translations' => [
                    'ru' => [
                        'name' => 'НИГИРИ ТУНЕЦ',
                        'slug' => 'nigiri-tunec',
                        'short_description' => 'Нигири с тунцом',
                        'full_description' => 'Свежий тунец на рисе с васаби'
                    ],
                    'ro' => [
                        'name' => 'NIGIRI TON',
                        'slug' => 'nigiri-ton',
                        'short_description' => 'Nigiri cu ton',
                        'full_description' => 'Ton proaspăt pe orez cu wasabi'
                    ],
                    'en' => [
                        'name' => 'TUNA NIGIRI',
                        'slug' => 'tuna-nigiri',
                        'short_description' => 'Tuna nigiri',
                        'full_description' => 'Fresh tuna on rice with wasabi'
                    ]
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'NIGIRI003',
                'price' => 48.00,
                'translations' => [
                    'ru' => [
                        'name' => 'НИГИРИ КРЕВЕТКА',
                        'slug' => 'nigiri-krevetka',
                        'short_description' => 'Нигири с креветкой',
                        'full_description' => 'Королевская креветка на рисе'
                    ],
                    'ro' => [
                        'name' => 'NIGIRI CREVETĂ',
                        'slug' => 'nigiri-creveta',
                        'short_description' => 'Nigiri cu crevetă',
                        'full_description' => 'Crevetă regală pe orez'
                    ],
                    'en' => [
                        'name' => 'SHRIMP NIGIRI',
                        'slug' => 'shrimp-nigiri',
                        'short_description' => 'Shrimp nigiri',
                        'full_description' => 'King shrimp on rice'
                    ]
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'NIGIRI004',
                'price' => 52.00,
                'translations' => [
                    'ru' => [
                        'name' => 'НИГИРИ УГОРЬ',
                        'slug' => 'nigiri-ugor',
                        'short_description' => 'Нигири с угрём унаги',
                        'full_description' => 'Копчёный угорь с унаги соусом'
                    ],
                    'ro' => [
                        'name' => 'NIGIRI ANGHILĂ',
                        'slug' => 'nigiri-anghila',
                        'short_description' => 'Nigiri cu anghilă unagi',
                        'full_description' => 'Anghilă afumată cu sos unagi'
                    ],
                    'en' => [
                        'name' => 'EEL NIGIRI',
                        'slug' => 'eel-nigiri',
                        'short_description' => 'Unagi eel nigiri',
                        'full_description' => 'Smoked eel with unagi sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'NIGIRI005',
                'price' => 46.00,
                'translations' => [
                    'ru' => [
                        'name' => 'НИГИРИ ГРЕБЕШОК',
                        'slug' => 'nigiri-grebeshok',
                        'short_description' => 'Нигири с морским гребешком',
                        'full_description' => 'Нежный морской гребешок на рисе'
                    ],
                    'ro' => [
                        'name' => 'NIGIRI SCOICĂ',
                        'slug' => 'nigiri-scoica',
                        'short_description' => 'Nigiri cu scoică',
                        'full_description' => 'Scoică delicată pe orez'
                    ],
                    'en' => [
                        'name' => 'SCALLOP NIGIRI',
                        'slug' => 'scallop-nigiri',
                        'short_description' => 'Scallop nigiri',
                        'full_description' => 'Tender scallop on rice'
                    ]
                ]
            ],

            // ============ GUNKAN / ГУНКАН (5 шт) ============
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'GUNKAN001',
                'price' => 55.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ГУНКАН ИКУРА',
                        'slug' => 'gunkan-ikura',
                        'short_description' => 'Гункан с икрой лосося',
                        'full_description' => 'Красная икра в корабле из нори'
                    ],
                    'ro' => [
                        'name' => 'GUNKAN IKURA',
                        'slug' => 'gunkan-ikura',
                        'short_description' => 'Gunkan cu icre de somon',
                        'full_description' => 'Icre roșii în corabia din nori'
                    ],
                    'en' => [
                        'name' => 'IKURA GUNKAN',
                        'slug' => 'ikura-gunkan',
                        'short_description' => 'Salmon roe gunkan',
                        'full_description' => 'Red roe in nori boat'
                    ]
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'GUNKAN002',
                'price' => 50.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ГУНКАН СПАЙСИ МАГУРО',
                        'slug' => 'gunkan-spicy-maguro',
                        'short_description' => 'Острый тунец в гункане',
                        'full_description' => 'Тунец со спайси соусом'
                    ],
                    'ro' => [
                        'name' => 'GUNKAN SPICY MAGURO',
                        'slug' => 'gunkan-spicy-maguro',
                        'short_description' => 'Ton picant în gunkan',
                        'full_description' => 'Ton cu sos spicy'
                    ],
                    'en' => [
                        'name' => 'SPICY MAGURO GUNKAN',
                        'slug' => 'spicy-maguro-gunkan',
                        'short_description' => 'Spicy tuna gunkan',
                        'full_description' => 'Tuna with spicy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'GUNKAN003',
                'price' => 48.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ГУНКАН ЧУКА',
                        'slug' => 'gunkan-chuka',
                        'short_description' => 'Гункан с водорослями чука',
                        'full_description' => 'Салат чука в гункане'
                    ],
                    'ro' => [
                        'name' => 'GUNKAN CHUKA',
                        'slug' => 'gunkan-chuka',
                        'short_description' => 'Gunkan cu alge chuka',
                        'full_description' => 'Salată chuka în gunkan'
                    ],
                    'en' => [
                        'name' => 'CHUKA GUNKAN',
                        'slug' => 'chuka-gunkan',
                        'short_description' => 'Chuka seaweed gunkan',
                        'full_description' => 'Chuka salad in gunkan'
                    ]
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'GUNKAN004',
                'price' => 52.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ГУНКАН КРЕВЕТКА СПАЙСИ',
                        'slug' => 'gunkan-shrimp-spicy',
                        'short_description' => 'Острая креветка',
                        'full_description' => 'Креветка в остром соусе'
                    ],
                    'ro' => [
                        'name' => 'GUNKAN CREVETĂ SPICY',
                        'slug' => 'gunkan-creveta-spicy',
                        'short_description' => 'Crevetă picantă',
                        'full_description' => 'Crevetă în sos picant'
                    ],
                    'en' => [
                        'name' => 'SPICY SHRIMP GUNKAN',
                        'slug' => 'spicy-shrimp-gunkan',
                        'short_description' => 'Spicy shrimp',
                        'full_description' => 'Shrimp in spicy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'GUNKAN005',
                'price' => 47.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ГУНКАН ТОБИКО',
                        'slug' => 'gunkan-tobiko',
                        'short_description' => 'Икра летучей рыбы',
                        'full_description' => 'Оранжевая икра тобико'
                    ],
                    'ro' => [
                        'name' => 'GUNKAN TOBIKO',
                        'slug' => 'gunkan-tobiko',
                        'short_description' => 'Icre de pește zburător',
                        'full_description' => 'Icre portocalii tobiko'
                    ],
                    'en' => [
                        'name' => 'TOBIKO GUNKAN',
                        'slug' => 'tobiko-gunkan',
                        'short_description' => 'Flying fish roe',
                        'full_description' => 'Orange tobiko roe'
                    ]
                ]
            ],

            // ============ SASHIMI / САШИМИ (5 шт) ============
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'SASH001',
                'price' => 120.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САШИМИ ЛОСОСЬ',
                        'slug' => 'sashimi-losos',
                        'short_description' => 'Классическое сашими',
                        'full_description' => '5 кусочков свежего лосося'
                    ],
                    'ro' => [
                        'name' => 'SASHIMI SOMON',
                        'slug' => 'sashimi-somon',
                        'short_description' => 'Sashimi clasic',
                        'full_description' => '5 bucăți de somon proaspăt'
                    ],
                    'en' => [
                        'name' => 'SALMON SASHIMI',
                        'slug' => 'salmon-sashimi',
                        'short_description' => 'Classic sashimi',
                        'full_description' => '5 pieces of fresh salmon'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SASH002',
                'price' => 135.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САШИМИ ТУНЕЦ',
                        'slug' => 'sashimi-tunec',
                        'short_description' => 'Премиум тунец',
                        'full_description' => '5 кусочков свежего тунца'
                    ],
                    'ro' => [
                        'name' => 'SASHIMI TON',
                        'slug' => 'sashimi-ton',
                        'short_description' => 'Ton premium',
                        'full_description' => '5 bucăți de ton proaspăt'
                    ],
                    'en' => [
                        'name' => 'TUNA SASHIMI',
                        'slug' => 'tuna-sashimi',
                        'short_description' => 'Premium tuna',
                        'full_description' => '5 pieces of fresh tuna'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SASH003',
                'price' => 150.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САШИМИ МИКС',
                        'slug' => 'sashimi-mix',
                        'short_description' => 'Ассорти из рыбы',
                        'full_description' => 'Лосось, тунец, окунь - по 3 кусочка'
                    ],
                    'ro' => [
                        'name' => 'SASHIMI MIX',
                        'slug' => 'sashimi-mix',
                        'short_description' => 'Sortiment de pește',
                        'full_description' => 'Somon, ton, biban - câte 3 bucăți'
                    ],
                    'en' => [
                        'name' => 'MIX SASHIMI',
                        'slug' => 'mix-sashimi',
                        'short_description' => 'Fish assortment',
                        'full_description' => 'Salmon, tuna, sea bass - 3 pcs each'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'SASH004',
                'price' => 140.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САШИМИ ОКУНЬ',
                        'slug' => 'sashimi-okun',
                        'short_description' => 'Морской окунь',
                        'full_description' => '5 кусочков свежего окуня'
                    ],
                    'ro' => [
                        'name' => 'SASHIMI BIBAN',
                        'slug' => 'sashimi-biban',
                        'short_description' => 'Biban de mare',
                        'full_description' => '5 bucăți de biban proaspăt'
                    ],
                    'en' => [
                        'name' => 'SEA BASS SASHIMI',
                        'slug' => 'sea-bass-sashimi',
                        'short_description' => 'Sea bass',
                        'full_description' => '5 pieces of fresh sea bass'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SASH005',
                'price' => 160.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САШИМИ ПРЕМИУМ',
                        'slug' => 'sashimi-premium',
                        'short_description' => 'Премиальная подача',
                        'full_description' => 'Лосось, тунец, гребешок, креветка'
                    ],
                    'ro' => [
                        'name' => 'SASHIMI PREMIUM',
                        'slug' => 'sashimi-premium',
                        'short_description' => 'Servire premium',
                        'full_description' => 'Somon, ton, scoică, crevetă'
                    ],
                    'en' => [
                        'name' => 'PREMIUM SASHIMI',
                        'slug' => 'premium-sashimi',
                        'short_description' => 'Premium serving',
                        'full_description' => 'Salmon, tuna, scallop, shrimp'
                    ]
                ]
            ],

            // ============ SUNOMONO / СУНОМОНО (5 шт) ============
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SUNO001',
                'price' => 45.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУНОМОНО КЛАССИЧЕСКИЙ',
                        'slug' => 'sunomono-klassicheskij',
                        'short_description' => 'Огурец в уксусе',
                        'full_description' => 'Маринованный огурец с рисовым уксусом'
                    ],
                    'ro' => [
                        'name' => 'SUNOMONO CLASIC',
                        'slug' => 'sunomono-clasic',
                        'short_description' => 'Castravete în oțet',
                        'full_description' => 'Castravete marinat cu oțet de orez'
                    ],
                    'en' => [
                        'name' => 'CLASSIC SUNOMONO',
                        'slug' => 'classic-sunomono',
                        'short_description' => 'Cucumber in vinegar',
                        'full_description' => 'Marinated cucumber with rice vinegar'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SUNO002',
                'price' => 55.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУНОМОНО МОРЕПРОДУКТЫ',
                        'slug' => 'sunomono-moreprodukty',
                        'short_description' => 'С креветкой и кальмаром',
                        'full_description' => 'Огурец, креветка, кальмар в уксусе'
                    ],
                    'ro' => [
                        'name' => 'SUNOMONO FRUCTE DE MARE',
                        'slug' => 'sunomono-fructe-mare',
                        'short_description' => 'Cu crevetă și calmar',
                        'full_description' => 'Castravete, crevetă, calmar în oțet'
                    ],
                    'en' => [
                        'name' => 'SEAFOOD SUNOMONO',
                        'slug' => 'seafood-sunomono',
                        'short_description' => 'With shrimp and squid',
                        'full_description' => 'Cucumber, shrimp, squid in vinegar'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SUNO003',
                'price' => 50.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУНОМОНО ЧУКА',
                        'slug' => 'sunomono-chuka',
                        'short_description' => 'С водорослями',
                        'full_description' => 'Огурец с салатом чука'
                    ],
                    'ro' => [
                        'name' => 'SUNOMONO CHUKA',
                        'slug' => 'sunomono-chuka',
                        'short_description' => 'Cu alge',
                        'full_description' => 'Castravete cu salată chuka'
                    ],
                    'en' => [
                        'name' => 'CHUKA SUNOMONO',
                        'slug' => 'chuka-sunomono',
                        'short_description' => 'With seaweed',
                        'full_description' => 'Cucumber with chuka salad'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SUNO004',
                'price' => 60.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУНОМОНО ОСЬМИНОГ',
                        'slug' => 'sunomono-osminog',
                        'short_description' => 'С осьминогом',
                        'full_description' => 'Маринованный осьминог с огурцом'
                    ],
                    'ro' => [
                        'name' => 'SUNOMONO CARACATIȚĂ',
                        'slug' => 'sunomono-caracatita',
                        'short_description' => 'Cu caracatiță',
                        'full_description' => 'Caracatiță marinată cu castravete'
                    ],
                    'en' => [
                        'name' => 'OCTOPUS SUNOMONO',
                        'slug' => 'octopus-sunomono',
                        'short_description' => 'With octopus',
                        'full_description' => 'Marinated octopus with cucumber'
                    ]
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SUNO005',
                'price' => 48.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУНОМОНО МИКС',
                        'slug' => 'sunomono-mix',
                        'short_description' => 'Овощной микс',
                        'full_description' => 'Огурец, морковь, дайкон в уксусе'
                    ],
                    'ro' => [
                        'name' => 'SUNOMONO MIX',
                        'slug' => 'sunomono-mix',
                        'short_description' => 'Mix de legume',
                        'full_description' => 'Castravete, morcov, daikon în oțet'
                    ],
                    'en' => [
                        'name' => 'MIX SUNOMONO',
                        'slug' => 'mix-sunomono',
                        'short_description' => 'Vegetable mix',
                        'full_description' => 'Cucumber, carrot, daikon in vinegar'
                    ]
                ]
            ],

            // ============ RICE / РИС (5 шт) ============
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'RICE001',
                'price' => 55.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИС ОВОЩИ',
                        'slug' => 'ris-ovoshchi',
                        'short_description' => 'Жареный рис с овощами',
                        'full_description' => 'Рис с овощным миксом'
                    ],
                    'ro' => [
                        'name' => 'OREZ LEGUME',
                        'slug' => 'orez-legume',
                        'short_description' => 'Orez prăjit cu legume',
                        'full_description' => 'Orez cu mix de legume'
                    ],
                    'en' => [
                        'name' => 'VEGETABLE RICE',
                        'slug' => 'vegetable-rice',
                        'short_description' => 'Fried rice with vegetables',
                        'full_description' => 'Rice with vegetable mix'
                    ]
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'RICE002',
                'price' => 65.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИС КУРИЦА',
                        'slug' => 'ris-kurica',
                        'short_description' => 'Рис с курицей терияки',
                        'full_description' => 'Жареный рис с курицей в соусе терияки'
                    ],
                    'ro' => [
                        'name' => 'OREZ PUI',
                        'slug' => 'orez-pui',
                        'short_description' => 'Orez cu pui teriyaki',
                        'full_description' => 'Orez prăjit cu pui în sos teriyaki'
                    ],
                    'en' => [
                        'name' => 'CHICKEN RICE',
                        'slug' => 'chicken-rice',
                        'short_description' => 'Rice with teriyaki chicken',
                        'full_description' => 'Fried rice with chicken in teriyaki sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'RICE003',
                'price' => 75.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИС КРЕВЕТКИ',
                        'slug' => 'ris-krevetki',
                        'short_description' => 'Рис с королевскими креветками',
                        'full_description' => 'Жареный рис с креветками и яйцом'
                    ],
                    'ro' => [
                        'name' => 'OREZ CREVEȚI',
                        'slug' => 'orez-creveti',
                        'short_description' => 'Orez cu creveți regali',
                        'full_description' => 'Orez prăjit cu creveți și ou'
                    ],
                    'en' => [
                        'name' => 'SHRIMP RICE',
                        'slug' => 'shrimp-rice',
                        'short_description' => 'Rice with king shrimp',
                        'full_description' => 'Fried rice with shrimp and egg'
                    ]
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'RICE004',
                'price' => 50.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИС ЯЙЦО',
                        'slug' => 'ris-yajco',
                        'short_description' => 'Простой жареный рис',
                        'full_description' => 'Жареный рис с яйцом и зелёным луком'
                    ],
                    'ro' => [
                        'name' => 'OREZ OU',
                        'slug' => 'orez-ou',
                        'short_description' => 'Orez prăjit simplu',
                        'full_description' => 'Orez prăjit cu ou și ceapă verde'
                    ],
                    'en' => [
                        'name' => 'EGG RICE',
                        'slug' => 'egg-rice',
                        'short_description' => 'Simple fried rice',
                        'full_description' => 'Fried rice with egg and green onion'
                    ]
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'RICE005',
                'price' => 80.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РИС МИКС',
                        'slug' => 'ris-mix',
                        'short_description' => 'Рис с мясом и морепродуктами',
                        'full_description' => 'Жареный рис с курицей, креветками и овощами'
                    ],
                    'ro' => [
                        'name' => 'OREZ MIX',
                        'slug' => 'orez-mix',
                        'short_description' => 'Orez cu carne și fructe de mare',
                        'full_description' => 'Orez prăjit cu pui, creveți și legume'
                    ],
                    'en' => [
                        'name' => 'MIX RICE',
                        'slug' => 'mix-rice',
                        'short_description' => 'Rice with meat and seafood',
                        'full_description' => 'Fried rice with chicken, shrimp and vegetables'
                    ]
                ]
            ],

            // ============ NOODLES / ЛАПША (5 шт) ============
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'NOOD001',
                'price' => 70.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РАМЕН КЛАССИЧЕСКИЙ',
                        'slug' => 'ramen-klassicheskij',
                        'short_description' => 'Японский суп-лапша',
                        'full_description' => 'Лапша в бульоне с яйцом и овощами'
                    ],
                    'ro' => [
                        'name' => 'RAMEN CLASIC',
                        'slug' => 'ramen-clasic',
                        'short_description' => 'Supă japoneză cu tăiței',
                        'full_description' => 'Tăiței în bulion cu ou și legume'
                    ],
                    'en' => [
                        'name' => 'CLASSIC RAMEN',
                        'slug' => 'classic-ramen',
                        'short_description' => 'Japanese noodle soup',
                        'full_description' => 'Noodles in broth with egg and vegetables'
                    ]
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'NOOD002',
                'price' => 85.00,
                'translations' => [
                    'ru' => [
                        'name' => 'РАМЕН МОРЕПРОДУКТЫ',
                        'slug' => 'ramen-moreprodukty',
                        'short_description' => 'С креветкой и кальмаром',
                        'full_description' => 'Лапша с морепродуктами в бульоне'
                    ],
                    'ro' => [
                        'name' => 'RAMEN FRUCTE DE MARE',
                        'slug' => 'ramen-fructe-mare',
                        'short_description' => 'Cu crevetă și calmar',
                        'full_description' => 'Tăiței cu fructe de mare în bulion'
                    ],
                    'en' => [
                        'name' => 'SEAFOOD RAMEN',
                        'slug' => 'seafood-ramen',
                        'short_description' => 'With shrimp and squid',
                        'full_description' => 'Noodles with seafood in broth'
                    ]
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'NOOD003',
                'price' => 65.00,
                'translations' => [
                    'ru' => [
                        'name' => 'УДОН ОВОЩИ',
                        'slug' => 'udon-ovoshchi',
                        'short_description' => 'Толстая лапша с овощами',
                        'full_description' => 'Удон с овощами в соевом соусе'
                    ],
                    'ro' => [
                        'name' => 'UDON LEGUME',
                        'slug' => 'udon-legume',
                        'short_description' => 'Tăiței groși cu legume',
                        'full_description' => 'Udon cu legume în sos de soia'
                    ],
                    'en' => [
                        'name' => 'VEGETABLE UDON',
                        'slug' => 'vegetable-udon',
                        'short_description' => 'Thick noodles with vegetables',
                        'full_description' => 'Udon with vegetables in soy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $brands['salmon']->id,
                'sku' => 'NOOD004',
                'price' => 80.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СОБА КУРИЦА',
                        'slug' => 'soba-kurica',
                        'short_description' => 'Гречневая лапша',
                        'full_description' => 'Соба с курицей и овощами'
                    ],
                    'ro' => [
                        'name' => 'SOBA PUI',
                        'slug' => 'soba-pui',
                        'short_description' => 'Tăiței din hrișcă',
                        'full_description' => 'Soba cu pui și legume'
                    ],
                    'en' => [
                        'name' => 'CHICKEN SOBA',
                        'slug' => 'chicken-soba',
                        'short_description' => 'Buckwheat noodles',
                        'full_description' => 'Soba with chicken and vegetables'
                    ]
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'NOOD005',
                'price' => 90.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ЯКИСОБА МИКС',
                        'slug' => 'yakisoba-mix',
                        'short_description' => 'Жареная лапша',
                        'full_description' => 'Жареная лапша с мясом и морепродуктами'
                    ],
                    'ro' => [
                        'name' => 'YAKISOBA MIX',
                        'slug' => 'yakisoba-mix',
                        'short_description' => 'Tăiței prăjiți',
                        'full_description' => 'Tăiței prăjiți cu carne și fructe de mare'
                    ],
                    'en' => [
                        'name' => 'MIX YAKISOBA',
                        'slug' => 'mix-yakisoba',
                        'short_description' => 'Fried noodles',
                        'full_description' => 'Fried noodles with meat and seafood'
                    ]
                ]
            ],

            // ============ SOUP / СУП (5 шт) ============
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SOUP001',
                'price' => 40.00,
                'translations' => [
                    'ru' => [
                        'name' => 'МИСО СУП',
                        'slug' => 'miso-sup',
                        'short_description' => 'Традиционный японский суп',
                        'full_description' => 'Суп на основе мисо-пасты с тофу'
                    ],
                    'ro' => [
                        'name' => 'SUPĂ MISO',
                        'slug' => 'supa-miso',
                        'short_description' => 'Supă japoneză tradițională',
                        'full_description' => 'Supă pe bază de pastă miso cu tofu'
                    ],
                    'en' => [
                        'name' => 'MISO SOUP',
                        'slug' => 'miso-soup',
                        'short_description' => 'Traditional Japanese soup',
                        'full_description' => 'Soup based on miso paste with tofu'
                    ]
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SOUP002',
                'price' => 55.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ТОМ ЯМ',
                        'slug' => 'tom-yam',
                        'short_description' => 'Острый тайский суп',
                        'full_description' => 'Кисло-острый суп с креветками'
                    ],
                    'ro' => [
                        'name' => 'TOM YAM',
                        'slug' => 'tom-yam',
                        'short_description' => 'Supă thailandeză picantă',
                        'full_description' => 'Supă acru-picantă cu creveți'
                    ],
                    'en' => [
                        'name' => 'TOM YAM',
                        'slug' => 'tom-yam',
                        'short_description' => 'Spicy Thai soup',
                        'full_description' => 'Sour-spicy soup with shrimp'
                    ]
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SOUP003',
                'price' => 45.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУП С ТОФУ',
                        'slug' => 'sup-tofu',
                        'short_description' => 'Вегетарианский суп',
                        'full_description' => 'Лёгкий суп с тофу и овощами'
                    ],
                    'ro' => [
                        'name' => 'SUPĂ CU TOFU',
                        'slug' => 'supa-tofu',
                        'short_description' => 'Supă vegetariană',
                        'full_description' => 'Supă ușoară cu tofu și legume'
                    ],
                    'en' => [
                        'name' => 'TOFU SOUP',
                        'slug' => 'tofu-soup',
                        'short_description' => 'Vegetarian soup',
                        'full_description' => 'Light soup with tofu and vegetables'
                    ]
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'SOUP004',
                'price' => 60.00,
                'translations' => [
                    'ru' => [
                        'name' => 'СУП МОРЕПРОДУКТЫ',
                        'slug' => 'sup-moreprodukty',
                        'short_description' => 'Суп с дарами моря',
                        'full_description' => 'Суп с креветками, кальмаром и мидиями'
                    ],
                    'ro' => [
                        'name' => 'SUPĂ FRUCTE DE MARE',
                        'slug' => 'supa-fructe-mare',
                        'short_description' => 'Supă cu daruri ale mării',
                        'full_description' => 'Supă cu creveți, calmar și midii'
                    ],
                    'en' => [
                        'name' => 'SEAFOOD SOUP',
                        'slug' => 'seafood-soup',
                        'short_description' => 'Soup with seafood',
                        'full_description' => 'Soup with shrimp, squid and mussels'
                    ]
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'SOUP005',
                'price' => 50.00,
                'translations' => [
                    'ru' => [
                        'name' => 'КУРИНЫЙ РАМЕН',
                        'slug' => 'kurinyj-ramen',
                        'short_description' => 'Суп с курицей',
                        'full_description' => 'Бульон с лапшой и куриным филе'
                    ],
                    'ro' => [
                        'name' => 'RAMEN DE PUI',
                        'slug' => 'ramen-pui',
                        'short_description' => 'Supă cu pui',
                        'full_description' => 'Bulion cu tăiței și file de pui'
                    ],
                    'en' => [
                        'name' => 'CHICKEN RAMEN',
                        'slug' => 'chicken-ramen',
                        'short_description' => 'Soup with chicken',
                        'full_description' => 'Broth with noodles and chicken fillet'
                    ]
                ]
            ],

            // ============ DRINKS / НАПИТКИ (5 шт) ============
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'DRINK001',
                'price' => 25.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ЗЕЛЁНЫЙ ЧАЙ',
                        'slug' => 'zelyonyj-chaj',
                        'short_description' => 'Традиционный японский чай',
                        'full_description' => 'Горячий зелёный чай сенча'
                    ],
                    'ro' => [
                        'name' => 'CEAI VERDE',
                        'slug' => 'ceai-verde',
                        'short_description' => 'Ceai japonez tradițional',
                        'full_description' => 'Ceai verde sencha fierbinte'
                    ],
                    'en' => [
                        'name' => 'GREEN TEA',
                        'slug' => 'green-tea',
                        'short_description' => 'Traditional Japanese tea',
                        'full_description' => 'Hot sencha green tea'
                    ]
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'DRINK002',
                'price' => 35.00,
                'translations' => [
                    'ru' => [
                        'name' => 'САКЕ',
                        'slug' => 'sake',
                        'short_description' => 'Рисовое вино',
                        'full_description' => 'Традиционное японское саке 300мл'
                    ],
                    'ro' => [
                        'name' => 'SAKE',
                        'slug' => 'sake',
                        'short_description' => 'Vin de orez',
                        'full_description' => 'Sake japonez tradițional 300ml'
                    ],
                    'en' => [
                        'name' => 'SAKE',
                        'slug' => 'sake',
                        'short_description' => 'Rice wine',
                        'full_description' => 'Traditional Japanese sake 300ml'
                    ]
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'DRINK003',
                'price' => 20.00,
                'translations' => [
                    'ru' => [
                        'name' => 'КОКА-КОЛА',
                        'slug' => 'coca-cola',
                        'short_description' => 'Газированный напиток',
                        'full_description' => 'Кока-Кола 330мл'
                    ],
                    'ro' => [
                        'name' => 'COCA-COLA',
                        'slug' => 'coca-cola',
                        'short_description' => 'Băutură carbogazoasă',
                        'full_description' => 'Coca-Cola 330ml'
                    ],
                    'en' => [
                        'name' => 'COCA-COLA',
                        'slug' => 'coca-cola',
                        'short_description' => 'Carbonated drink',
                        'full_description' => 'Coca-Cola 330ml'
                    ]
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $brands['rice']->id,
                'sku' => 'DRINK004',
                'price' => 30.00,
                'translations' => [
                    'ru' => [
                        'name' => 'ЛИМОНАД ЮДЗУ',
                        'slug' => 'limonad-yuzu',
                        'short_description' => 'Японский цитрусовый лимонад',
                        'full_description' => 'Освежающий лимонад с юдзу'
                    ],
                    'ro' => [
                        'name' => 'LIMONADĂ YUZU',
                        'slug' => 'limonada-yuzu',
                        'short_description' => 'Limonadă japoneză cu citrice',
                        'full_description' => 'Limonadă revigorantă cu yuzu'
                    ],
                    'en' => [
                        'name' => 'YUZU LEMONADE',
                        'slug' => 'yuzu-lemonade',
                        'short_description' => 'Japanese citrus lemonade',
                        'full_description' => 'Refreshing yuzu lemonade'
                    ]
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $brands['ocean']->id,
                'sku' => 'DRINK005',
                'price' => 28.00,
                'translations' => [
                    'ru' => [
                        'name' => 'АСАХИ ПИВО',
                        'slug' => 'asahi-pivo',
                        'short_description' => 'Японское пиво',
                        'full_description' => 'Asahi Super Dry 330мл'
                    ],
                    'ro' => [
                        'name' => 'ASAHI BERE',
                        'slug' => 'asahi-bere',
                        'short_description' => 'Bere japoneză',
                        'full_description' => 'Asahi Super Dry 330ml'
                    ],
                    'en' => [
                        'name' => 'ASAHI BEER',
                        'slug' => 'asahi-beer',
                        'short_description' => 'Japanese beer',
                        'full_description' => 'Asahi Super Dry 330ml'
                    ]
                ]
            ],
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use App\Models\Product;
use App\Models\ProductTranslation;

class SushiDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->createCategories();
        $this->createBrands();
        $this->createAttributes();
        $this->createProducts();
    }

    private function createCategories(): void
    {
        $categories = [
            [
                'image' => 'categories/nigiri.jpg',
                'translations' => [
                    'ru' => ['name' => 'Nigiri', 'slug' => 'nigiri'],
                    'ro' => ['name' => 'Nigiri', 'slug' => 'nigiri'],
                    'en' => ['name' => 'Nigiri', 'slug' => 'nigiri'],
                ]
            ],
            [
                'image' => 'categories/gunkan.jpg',
                'translations' => [
                    'ru' => ['name' => 'Gunkan', 'slug' => 'gunkan'],
                    'ro' => ['name' => 'Gunkan', 'slug' => 'gunkan'],
                    'en' => ['name' => 'Gunkan', 'slug' => 'gunkan'],
                ]
            ],
            [
                'image' => 'categories/hosomaki.jpg',
                'translations' => [
                    'ru' => ['name' => 'Hosomaki', 'slug' => 'hosomaki'],
                    'ro' => ['name' => 'Hosomaki', 'slug' => 'hosomaki'],
                    'en' => ['name' => 'Hosomaki', 'slug' => 'hosomaki'],
                ]
            ],
            [
                'image' => 'categories/uromaki.jpg',
                'translations' => [
                    'ru' => ['name' => 'Uromaki', 'slug' => 'uromaki'],
                    'ro' => ['name' => 'Uromaki', 'slug' => 'uromaki'],
                    'en' => ['name' => 'Uromaki', 'slug' => 'uromaki'],
                ]
            ],
            [
                'image' => 'categories/tempura.jpg',
                'translations' => [
                    'ru' => ['name' => 'Tempura', 'slug' => 'tempura'],
                    'ro' => ['name' => 'Tempura', 'slug' => 'tempura'],
                    'en' => ['name' => 'Tempura', 'slug' => 'tempura'],
                ]
            ],
            [
                'image' => 'categories/sashimi.jpg',
                'translations' => [
                    'ru' => ['name' => 'Sashimi', 'slug' => 'sashimi'],
                    'ro' => ['name' => 'Sashimi', 'slug' => 'sashimi'],
                    'en' => ['name' => 'Sashimi', 'slug' => 'sashimi'],
                ]
            ],
            [
                'image' => 'categories/sets.jpg',
                'translations' => [
                    'ru' => ['name' => 'Сеты', 'slug' => 'sety'],
                    'ro' => ['name' => 'Seturi', 'slug' => 'seturi'],
                    'en' => ['name' => 'Sets', 'slug' => 'sets'],
                ]
            ],
            [
                'image' => 'categories/sunomono.jpg',
                'translations' => [
                    'ru' => ['name' => 'Sunomono', 'slug' => 'sunomono'],
                    'ro' => ['name' => 'Sunomono', 'slug' => 'sunomono'],
                    'en' => ['name' => 'Sunomono', 'slug' => 'sunomono'],
                ]
            ],
            [
                'image' => 'categories/noodles.jpg',
                'translations' => [
                    'ru' => ['name' => 'Лапша', 'slug' => 'lapsha'],
                    'ro' => ['name' => 'Tăiței', 'slug' => 'taitei'],
                    'en' => ['name' => 'Noodles', 'slug' => 'noodles'],
                ]
            ],
            [
                'image' => 'categories/rice.jpg',
                'translations' => [
                    'ru' => ['name' => 'Рис', 'slug' => 'ris'],
                    'ro' => ['name' => 'Orez', 'slug' => 'orez'],
                    'en' => ['name' => 'Rice', 'slug' => 'rice'],
                ]
            ],
            [
                'image' => 'categories/soup.jpg',
                'translations' => [
                    'ru' => ['name' => 'Суп', 'slug' => 'sup'],
                    'ro' => ['name' => 'Supă', 'slug' => 'supa'],
                    'en' => ['name' => 'Soup', 'slug' => 'soup'],
                ]
            ],
            [
                'image' => 'categories/drinks.jpg',
                'translations' => [
                    'ru' => ['name' => 'Напитки', 'slug' => 'napitki'],
                    'ro' => ['name' => 'Băuturi', 'slug' => 'bauturi'],
                    'en' => ['name' => 'Drinks', 'slug' => 'drinks'],
                ]
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'image' => $categoryData['image'],
                'parent_id' => null
            ]);

            foreach ($categoryData['translations'] as $lang => $translation) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'slug' => $translation['slug']
                ]);
            }
        }
    }

    private function createBrands(): void
    {
        $brands = [
            [
                'logo' => 'brands/salmon-king.jpg',
                'translations' => [
                    'ru' => ['name' => 'Salmon King', 'slug' => 'salmon-king'],
                    'ro' => ['name' => 'Salmon King', 'slug' => 'salmon-king'],
                    'en' => ['name' => 'Salmon King', 'slug' => 'salmon-king'],
                ]
            ],
            [
                'logo' => 'brands/rice-master.jpg',
                'translations' => [
                    'ru' => ['name' => 'Rice Master', 'slug' => 'rice-master'],
                    'ro' => ['name' => 'Rice Master', 'slug' => 'rice-master'],
                    'en' => ['name' => 'Rice Master', 'slug' => 'rice-master'],
                ]
            ],
            [
                'logo' => 'brands/ocean-fresh.jpg',
                'translations' => [
                    'ru' => ['name' => 'Ocean Fresh', 'slug' => 'ocean-fresh'],
                    'ro' => ['name' => 'Ocean Fresh', 'slug' => 'ocean-fresh'],
                    'en' => ['name' => 'Ocean Fresh', 'slug' => 'ocean-fresh'],
                ]
            ]
        ];

        foreach ($brands as $brandData) {
            $brand = Brand::create([
                'logo' => $brandData['logo'],
                'is_active' => true,
                'sort_order' => 0
            ]);

            foreach ($brandData['translations'] as $lang => $translation) {
                BrandTranslation::create([
                    'brand_id' => $brand->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'slug' => $translation['slug']
                ]);
            }
        }
    }

    private function createAttributes(): void
    {
        // 1. Размер порции
        $sizeAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => 'шт',
            'is_filterable' => true,
            'is_variant' => true,
            'sort_order' => 1
        ]);

        AttributeTranslation::create(['attribute_id' => $sizeAttr->id, 'language' => 'ru', 'name' => 'Размер']);
        AttributeTranslation::create(['attribute_id' => $sizeAttr->id, 'language' => 'ro', 'name' => 'Mărime']);
        AttributeTranslation::create(['attribute_id' => $sizeAttr->id, 'language' => 'en', 'name' => 'Size']);

        $sizeValues = [
            ['ru' => 'Маленький (6 шт)', 'ro' => 'Mic (6 buc)', 'en' => 'Small (6 pcs)'],
            ['ru' => 'Средний (8 шт)', 'ro' => 'Mediu (8 buc)', 'en' => 'Medium (8 pcs)'],
            ['ru' => 'Большой (10 шт)', 'ro' => 'Mare (10 buc)', 'en' => 'Large (10 pcs)']
        ];

        foreach ($sizeValues as $index => $valueData) {
            $value = AttributeValue::create([
                'attribute_id' => $sizeAttr->id,
                'sort_order' => $index + 1
            ]);

            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }

        // 2. Острота
        $spicyAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => null,
            'is_filterable' => true,
            'is_variant' => false,
            'sort_order' => 2
        ]);

        AttributeTranslation::create(['attribute_id' => $spicyAttr->id, 'language' => 'ru', 'name' => 'Острота']);
        AttributeTranslation::create(['attribute_id' => $spicyAttr->id, 'language' => 'ro', 'name' => 'Picant']);
        AttributeTranslation::create(['attribute_id' => $spicyAttr->id, 'language' => 'en', 'name' => 'Spiciness']);

        $spicyValues = [
            ['ru' => 'Неострое', 'ro' => 'Nu e picant', 'en' => 'Mild'],
            ['ru' => 'Средне-острое', 'ro' => 'Mediu picant', 'en' => 'Medium spicy'],
            ['ru' => 'Очень острое', 'ro' => 'Foarte picant', 'en' => 'Very spicy']
        ];

        foreach ($spicyValues as $index => $valueData) {
            $value = AttributeValue::create([
                'attribute_id' => $spicyAttr->id,
                'sort_order' => $index + 1
            ]);

            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }
    }

    private function createProducts(): void
    {
        // Используем новые категории
        $nigiriCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'nigiri');
        })->first();

        $gunkanCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'gunkan');
        })->first();

        $uromakiCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'uromaki');
        })->first();

        $tempuraCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'tempura');
        })->first();

        $setsCategory = Category::whereHas('translations', function ($q) {
            $q->where('slug', 'sety');
        })->first();

        $salmonBrand = Brand::whereHas('translations', function ($q) {
            $q->where('slug', 'salmon-king');
        })->first();

        $oceanBrand = Brand::whereHas('translations', function ($q) {
            $q->where('slug', 'ocean-fresh');
        })->first();

        $products = [
            [
                'category_id' => $nigiriCategory->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'NIGIRI001',
                'price' => 8.50,
                'currency' => 'MDL',
                'translations' => [
                    'ru' => [
                        'name' => 'Nigiri Лосось',
                        'slug' => 'nigiri-losos',
                        'short_description' => 'Классические нигири с лососем',
                        'full_description' => 'Свежий лосось на рисовой подушке, приправленной васаби'
                    ],
                    'ro' => [
                        'name' => 'Nigiri Somon',
                        'slug' => 'nigiri-somon',
                        'short_description' => 'Nigiri clasic cu somon',
                        'full_description' => 'Somon proaspăt pe pernuță de orez condimentată cu wasabi'
                    ],
                    'en' => [
                        'name' => 'Salmon Nigiri',
                        'slug' => 'salmon-nigiri',
                        'short_description' => 'Classic salmon nigiri',
                        'full_description' => 'Fresh salmon on wasabi-seasoned rice pillow'
                    ]
                ]
            ],
            [
                'category_id' => $gunkanCategory->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'GUNKAN001',
                'price' => 9.00,
                'currency' => 'MDL',
                'translations' => [
                    'ru' => [
                        'name' => 'Gunkan Икура',
                        'slug' => 'gunkan-ikura',
                        'short_description' => 'Гункан с икрой лосося',
                        'full_description' => 'Красная икра лосося в корабле из нори на рисе'
                    ],
                    'ro' => [
                        'name' => 'Gunkan Ikura',
                        'slug' => 'gunkan-ikura',
                        'short_description' => 'Gunkan cu icre de somon',
                        'full_description' => 'Icre roșii de somon în corabia din nori pe orez'
                    ],
                    'en' => [
                        'name' => 'Ikura Gunkan',
                        'slug' => 'ikura-gunkan',
                        'short_description' => 'Gunkan with salmon roe',
                        'full_description' => 'Red salmon roe in nori boat on rice'
                    ]
                ]
            ],
            [
                'category_id' => $uromakiCategory->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'UROMAKI001',
                'price' => 15.50,
                'currency' => 'MDL',
                'translations' => [
                    'ru' => [
                        'name' => 'Uromaki Филадельфия',
                        'slug' => 'uromaki-filadelfia',
                        'short_description' => 'Классический урамаки с лососем и сливочным сыром',
                        'full_description' => 'Лосось, сливочный сыр Philadelphia, огурец, завернутые в нори'
                    ],
                    'ro' => [
                        'name' => 'Uromaki Philadelphia',
                        'slug' => 'uromaki-philadelphia',
                        'short_description' => 'Uromaki clasic cu somon și brânză cremă',
                        'full_description' => 'Somon, brânză cremă Philadelphia, castravete, înfășurate în nori'
                    ],
                    'en' => [
                        'name' => 'Philadelphia Uromaki',
                        'slug' => 'philadelphia-uromaki',
                        'short_description' => 'Classic uromaki with salmon and cream cheese',
                        'full_description' => 'Salmon, Philadelphia cream cheese, cucumber, wrapped in nori'
                    ]
                ]
            ],
            [
                'category_id' => $tempuraCategory->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'TEMP001',
                'price' => 18.00,
                'currency' => 'MDL',
                'translations' => [
                    'ru' => [
                        'name' => 'Tempura Roll Эби',
                        'slug' => 'tempura-roll-ebi',
                        'short_description' => 'Ролл с креветкой темпура',
                        'full_description' => 'Креветка в хрустящей темпуре, авокадо, спайси соус'
                    ],
                    'ro' => [
                        'name' => 'Tempura Roll Ebi',
                        'slug' => 'tempura-roll-ebi',
                        'short_description' => 'Roll cu crevetă tempura',
                        'full_description' => 'Crevetă în tempura crocantă, avocado, sos spicy'
                    ],
                    'en' => [
                        'name' => 'Ebi Tempura Roll',
                        'slug' => 'ebi-tempura-roll',
                        'short_description' => 'Roll with tempura shrimp',
                        'full_description' => 'Shrimp in crispy tempura, avocado, spicy sauce'
                    ]
                ]
            ],
            [
                'category_id' => $setsCategory->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SET001',
                'price' => 45.00,
                'currency' => 'MDL',
                'translations' => [
                    'ru' => [
                        'name' => 'Сет для двоих',
                        'slug' => 'set-dlya-dvoih',
                        'short_description' => 'Разнообразный набор суши и роллов для пары',
                        'full_description' => '2 Нигири лосось, 2 Нигири тунец, 8 Филадельфия, 8 Калифорния, имбирь, васаби, соевый соус'
                    ],
                    'ro' => [
                        'name' => 'Set pentru doi',
                        'slug' => 'set-pentru-doi',
                        'short_description' => 'Set variat de sushi și roll-uri pentru cuplu',
                        'full_description' => '2 Nigiri somon, 2 Nigiri ton, 8 Philadelphia, 8 California, ghimbir, wasabi, sos de soia'
                    ],
                    'en' => [
                        'name' => 'Set for Two',
                        'slug' => 'set-for-two',
                        'short_description' => 'Varied set of sushi and rolls for couple',
                        'full_description' => '2 Salmon Nigiri, 2 Tuna Nigiri, 8 Philadelphia, 8 California, ginger, wasabi, soy sauce'
                    ]
                ]
            ]
        ];

        foreach ($products as $productData) {
            $product = Product::create([
                'category_id' => $productData['category_id'],
                'brand_id' => $productData['brand_id'],
                'sku' => $productData['sku'],
                'price' => $productData['price'],
                'currency' => $productData['currency'],
                'is_active' => true,
                'sort_order' => 0
            ]);

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
}

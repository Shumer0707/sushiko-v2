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
        // Получаем все категории по slug
        $categories = [
            'nigiri' => Category::whereHas('translations', fn($q) => $q->where('slug', 'nigiri'))->first(),
            'gunkan' => Category::whereHas('translations', fn($q) => $q->where('slug', 'gunkan'))->first(),
            'hosomaki' => Category::whereHas('translations', fn($q) => $q->where('slug', 'hosomaki'))->first(),
            'uromaki' => Category::whereHas('translations', fn($q) => $q->where('slug', 'uromaki'))->first(),
            'tempura' => Category::whereHas('translations', fn($q) => $q->where('slug', 'tempura'))->first(),
            'sashimi' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sashimi'))->first(),
            'sets' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sety'))->first(),
            'sunomono' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sunomono'))->first(),
            'noodles' => Category::whereHas('translations', fn($q) => $q->where('slug', 'lapsha'))->first(),
            'rice' => Category::whereHas('translations', fn($q) => $q->where('slug', 'ris'))->first(),
            'soup' => Category::whereHas('translations', fn($q) => $q->where('slug', 'sup'))->first(),
            'drinks' => Category::whereHas('translations', fn($q) => $q->where('slug', 'napitki'))->first(),
        ];

        // Получаем бренды
        $salmonBrand = Brand::whereHas('translations', fn($q) => $q->where('slug', 'salmon-king'))->first();
        $oceanBrand = Brand::whereHas('translations', fn($q) => $q->where('slug', 'ocean-fresh'))->first();
        $riceBrand = Brand::whereHas('translations', fn($q) => $q->where('slug', 'rice-master'))->first();

        // Массив всех товаров
        $products = [
            // ============ NIGIRI (5 шт) ============
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'NIGIRI001',
                'price' => 45.00,
                'translations' => [
                    'ru' => ['name' => 'Nigiri Лосось', 'slug' => 'nigiri-losos', 'short_description' => 'Классические нигири с лососем', 'full_description' => 'Свежий лосось на рисовой подушке'],
                    'ro' => ['name' => 'Nigiri Somon', 'slug' => 'nigiri-somon', 'short_description' => 'Nigiri clasic cu somon', 'full_description' => 'Somon proaspăt pe pernuță de orez'],
                    'en' => ['name' => 'Salmon Nigiri', 'slug' => 'salmon-nigiri', 'short_description' => 'Classic salmon nigiri', 'full_description' => 'Fresh salmon on rice pillow']
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'NIGIRI002',
                'price' => 50.00,
                'translations' => [
                    'ru' => ['name' => 'Nigiri Тунец', 'slug' => 'nigiri-tunec', 'short_description' => 'Нигири с тунцом', 'full_description' => 'Свежий тунец на рисе с васаби'],
                    'ro' => ['name' => 'Nigiri Ton', 'slug' => 'nigiri-ton', 'short_description' => 'Nigiri cu ton', 'full_description' => 'Ton proaspăt pe orez cu wasabi'],
                    'en' => ['name' => 'Tuna Nigiri', 'slug' => 'tuna-nigiri', 'short_description' => 'Tuna nigiri', 'full_description' => 'Fresh tuna on rice with wasabi']
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'NIGIRI003',
                'price' => 48.00,
                'translations' => [
                    'ru' => ['name' => 'Nigiri Креветка', 'slug' => 'nigiri-krevetka', 'short_description' => 'Нигири с креветкой', 'full_description' => 'Королевская креветка на рисе'],
                    'ro' => ['name' => 'Nigiri Crevetă', 'slug' => 'nigiri-creveta', 'short_description' => 'Nigiri cu crevetă', 'full_description' => 'Crevetă regală pe orez'],
                    'en' => ['name' => 'Shrimp Nigiri', 'slug' => 'shrimp-nigiri', 'short_description' => 'Shrimp nigiri', 'full_description' => 'King shrimp on rice']
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'NIGIRI004',
                'price' => 52.00,
                'translations' => [
                    'ru' => ['name' => 'Nigiri Угорь', 'slug' => 'nigiri-ugor', 'short_description' => 'Нигири с угрём унаги', 'full_description' => 'Копчёный угорь с унаги соусом'],
                    'ro' => ['name' => 'Nigiri Anghilă', 'slug' => 'nigiri-anghila', 'short_description' => 'Nigiri cu anghilă unagi', 'full_description' => 'Anghilă afumată cu sos unagi'],
                    'en' => ['name' => 'Eel Nigiri', 'slug' => 'eel-nigiri', 'short_description' => 'Unagi eel nigiri', 'full_description' => 'Smoked eel with unagi sauce']
                ]
            ],
            [
                'category_id' => $categories['nigiri']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'NIGIRI005',
                'price' => 46.00,
                'translations' => [
                    'ru' => ['name' => 'Nigiri Гребешок', 'slug' => 'nigiri-grebeshok', 'short_description' => 'Нигири с морским гребешком', 'full_description' => 'Нежный морской гребешок на рисе'],
                    'ro' => ['name' => 'Nigiri Scoică', 'slug' => 'nigiri-scoica', 'short_description' => 'Nigiri cu scoică', 'full_description' => 'Scoică delicată pe orez'],
                    'en' => ['name' => 'Scallop Nigiri', 'slug' => 'scallop-nigiri', 'short_description' => 'Scallop nigiri', 'full_description' => 'Tender scallop on rice']
                ]
            ],

            // ============ GUNKAN (5 шт) ============
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'GUNKAN001',
                'price' => 55.00,
                'translations' => [
                    'ru' => ['name' => 'Gunkan Икура', 'slug' => 'gunkan-ikura', 'short_description' => 'Гункан с икрой лосося', 'full_description' => 'Красная икра в корабле из нори'],
                    'ro' => ['name' => 'Gunkan Ikura', 'slug' => 'gunkan-ikura', 'short_description' => 'Gunkan cu icre de somon', 'full_description' => 'Icre roșii în corabia din nori'],
                    'en' => ['name' => 'Ikura Gunkan', 'slug' => 'ikura-gunkan', 'short_description' => 'Salmon roe gunkan', 'full_description' => 'Red roe in nori boat']
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'GUNKAN002',
                'price' => 50.00,
                'translations' => [
                    'ru' => ['name' => 'Gunkan Спайси Магуро', 'slug' => 'gunkan-spicy-maguro', 'short_description' => 'Острый тунец в гункане', 'full_description' => 'Тунец со спайси соусом'],
                    'ro' => ['name' => 'Gunkan Spicy Maguro', 'slug' => 'gunkan-spicy-maguro', 'short_description' => 'Ton picant în gunkan', 'full_description' => 'Ton cu sos spicy'],
                    'en' => ['name' => 'Spicy Maguro Gunkan', 'slug' => 'spicy-maguro-gunkan', 'short_description' => 'Spicy tuna gunkan', 'full_description' => 'Tuna with spicy sauce']
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'GUNKAN003',
                'price' => 48.00,
                'translations' => [
                    'ru' => ['name' => 'Gunkan Чука', 'slug' => 'gunkan-chuka', 'short_description' => 'Гункан с водорослями чука', 'full_description' => 'Салат чука в гункане'],
                    'ro' => ['name' => 'Gunkan Chuka', 'slug' => 'gunkan-chuka', 'short_description' => 'Gunkan cu alge chuka', 'full_description' => 'Salată chuka în gunkan'],
                    'en' => ['name' => 'Chuka Gunkan', 'slug' => 'chuka-gunkan', 'short_description' => 'Chuka seaweed gunkan', 'full_description' => 'Chuka salad in gunkan']
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'GUNKAN004',
                'price' => 52.00,
                'translations' => [
                    'ru' => ['name' => 'Gunkan Креветка Спайси', 'slug' => 'gunkan-shrimp-spicy', 'short_description' => 'Острая креветка', 'full_description' => 'Креветка в остром соусе'],
                    'ro' => ['name' => 'Gunkan Crevetă Spicy', 'slug' => 'gunkan-creveta-spicy', 'short_description' => 'Crevetă picantă', 'full_description' => 'Crevetă în sos picant'],
                    'en' => ['name' => 'Spicy Shrimp Gunkan', 'slug' => 'spicy-shrimp-gunkan', 'short_description' => 'Spicy shrimp', 'full_description' => 'Shrimp in spicy sauce']
                ]
            ],
            [
                'category_id' => $categories['gunkan']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'GUNKAN005',
                'price' => 47.00,
                'translations' => [
                    'ru' => ['name' => 'Gunkan Тобико', 'slug' => 'gunkan-tobiko', 'short_description' => 'Икра летучей рыбы', 'full_description' => 'Оранжевая икра тобико'],
                    'ro' => ['name' => 'Gunkan Tobiko', 'slug' => 'gunkan-tobiko', 'short_description' => 'Icre de pește zburător', 'full_description' => 'Icre portocalii tobiko'],
                    'en' => ['name' => 'Tobiko Gunkan', 'slug' => 'tobiko-gunkan', 'short_description' => 'Flying fish roe', 'full_description' => 'Orange tobiko roe']
                ]
            ],

            // ============ HOSOMAKI (5 шт) ============
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'HOSO001',
                'price' => 35.00,
                'translations' => [
                    'ru' => ['name' => 'Hosomaki Лосось', 'slug' => 'hosomaki-losos', 'short_description' => 'Тонкий ролл с лососем', 'full_description' => 'Классический хосомаки с лососем'],
                    'ro' => ['name' => 'Hosomaki Somon', 'slug' => 'hosomaki-somon', 'short_description' => 'Roll subțire cu somon', 'full_description' => 'Hosomaki clasic cu somon'],
                    'en' => ['name' => 'Salmon Hosomaki', 'slug' => 'salmon-hosomaki', 'short_description' => 'Thin roll with salmon', 'full_description' => 'Classic salmon hosomaki']
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'HOSO002',
                'price' => 38.00,
                'translations' => [
                    'ru' => ['name' => 'Hosomaki Тунец', 'slug' => 'hosomaki-tunec', 'short_description' => 'Тонкий ролл с тунцом', 'full_description' => 'Свежий тунец в нори'],
                    'ro' => ['name' => 'Hosomaki Ton', 'slug' => 'hosomaki-ton', 'short_description' => 'Roll subțire cu ton', 'full_description' => 'Ton proaspăt în nori'],
                    'en' => ['name' => 'Tuna Hosomaki', 'slug' => 'tuna-hosomaki', 'short_description' => 'Thin roll with tuna', 'full_description' => 'Fresh tuna in nori']
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'HOSO003',
                'price' => 30.00,
                'translations' => [
                    'ru' => ['name' => 'Hosomaki Огурец', 'slug' => 'hosomaki-ogurec', 'short_description' => 'Вегетарианский ролл', 'full_description' => 'Свежий огурец в рисе и нори'],
                    'ro' => ['name' => 'Hosomaki Castravete', 'slug' => 'hosomaki-castravete', 'short_description' => 'Roll vegetarian', 'full_description' => 'Castravete proaspăt în orez și nori'],
                    'en' => ['name' => 'Cucumber Hosomaki', 'slug' => 'cucumber-hosomaki', 'short_description' => 'Vegetarian roll', 'full_description' => 'Fresh cucumber in rice and nori']
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'HOSO004',
                'price' => 40.00,
                'translations' => [
                    'ru' => ['name' => 'Hosomaki Угорь', 'slug' => 'hosomaki-ugor', 'short_description' => 'Копчёный угорь', 'full_description' => 'Угорь с соусом унаги'],
                    'ro' => ['name' => 'Hosomaki Anghilă', 'slug' => 'hosomaki-anghila', 'short_description' => 'Anghilă afumată', 'full_description' => 'Anghilă cu sos unagi'],
                    'en' => ['name' => 'Eel Hosomaki', 'slug' => 'eel-hosomaki', 'short_description' => 'Smoked eel', 'full_description' => 'Eel with unagi sauce']
                ]
            ],
            [
                'category_id' => $categories['hosomaki']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'HOSO005',
                'price' => 32.00,
                'translations' => [
                    'ru' => ['name' => 'Hosomaki Авокадо', 'slug' => 'hosomaki-avokado', 'short_description' => 'Вегетарианский с авокадо', 'full_description' => 'Спелое авокадо в рисе'],
                    'ro' => ['name' => 'Hosomaki Avocado', 'slug' => 'hosomaki-avocado', 'short_description' => 'Vegetarian cu avocado', 'full_description' => 'Avocado copt în orez'],
                    'en' => ['name' => 'Avocado Hosomaki', 'slug' => 'avocado-hosomaki', 'short_description' => 'Vegetarian with avocado', 'full_description' => 'Ripe avocado in rice']
                ]
            ],

            // ============ UROMAKI (5 шт) ============
            [
                'category_id' => $categories['uromaki']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'URO001',
                'price' => 85.00,
                'translations' => [
                    'ru' => ['name' => 'Uromaki Филадельфия', 'slug' => 'uromaki-philadelphia', 'short_description' => 'Классический ролл', 'full_description' => 'Лосось, сливочный сыр, огурец'],
                    'ro' => ['name' => 'Uromaki Philadelphia', 'slug' => 'uromaki-philadelphia', 'short_description' => 'Roll clasic', 'full_description' => 'Somon, brânză cremă, castravete'],
                    'en' => ['name' => 'Philadelphia Uromaki', 'slug' => 'philadelphia-uromaki', 'short_description' => 'Classic roll', 'full_description' => 'Salmon, cream cheese, cucumber']
                ]
            ],
            [
                'category_id' => $categories['uromaki']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'URO002',
                'price' => 80.00,
                'translations' => [
                    'ru' => ['name' => 'Uromaki Калифорния', 'slug' => 'uromaki-california', 'short_description' => 'С крабом и икрой', 'full_description' => 'Краб, авокадо, огурец, икра масаго'],
                    'ro' => ['name' => 'Uromaki California', 'slug' => 'uromaki-california', 'short_description' => 'Cu crab și icre', 'full_description' => 'Crab, avocado, castravete, icre masago'],
                    'en' => ['name' => 'California Uromaki', 'slug' => 'california-uromaki', 'short_description' => 'With crab and roe', 'full_description' => 'Crab, avocado, cucumber, masago roe']
                ]
            ],
            [
                'category_id' => $categories['uromaki']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'URO003',
                'price' => 90.00,
                'translations' => [
                    'ru' => ['name' => 'Uromaki Дракон', 'slug' => 'uromaki-dragon', 'short_description' => 'С угрём сверху', 'full_description' => 'Креветка, авокадо, угорь сверху'],
                    'ro' => ['name' => 'Uromaki Dragon', 'slug' => 'uromaki-dragon', 'short_description' => 'Cu anghilă deasupra', 'full_description' => 'Crevetă, avocado, anghilă deasupra'],
                    'en' => ['name' => 'Dragon Uromaki', 'slug' => 'dragon-uromaki', 'short_description' => 'With eel on top', 'full_description' => 'Shrimp, avocado, eel on top']
                ]
            ],
            [
                'category_id' => $categories['uromaki']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'URO004',
                'price' => 88.00,
                'translations' => [
                    'ru' => ['name' => 'Uromaki Радуга', 'slug' => 'uromaki-rainbow', 'short_description' => 'Микс рыбы сверху', 'full_description' => 'Лосось, тунец, окунь сверху калифорнии'],
                    'ro' => ['name' => 'Uromaki Curcubeu', 'slug' => 'uromaki-curcubeu', 'short_description' => 'Mix de pește deasupra', 'full_description' => 'Somon, ton, biban deasupra California'],
                    'en' => ['name' => 'Rainbow Uromaki', 'slug' => 'rainbow-uromaki', 'short_description' => 'Fish mix on top', 'full_description' => 'Salmon, tuna, sea bass on California']
                ]
            ],
            [
                'category_id' => $categories['uromaki']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'URO005',
                'price' => 92.00,
                'translations' => [
                    'ru' => ['name' => 'Uromaki Лава', 'slug' => 'uromaki-lava', 'short_description' => 'Острый запечённый ролл', 'full_description' => 'Лосось, спайси соус, запечённый сыр'],
                    'ro' => ['name' => 'Uromaki Lava', 'slug' => 'uromaki-lava', 'short_description' => 'Roll picant copt', 'full_description' => 'Somon, sos spicy, brânză coaptă'],
                    'en' => ['name' => 'Lava Uromaki', 'slug' => 'lava-uromaki', 'short_description' => 'Spicy baked roll', 'full_description' => 'Salmon, spicy sauce, baked cheese']
                ]
            ],

            // ============ TEMPURA (5 шт) ============
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'TEMP001',
                'price' => 95.00,
                'translations' => [
                    'ru' => ['name' => 'Tempura Эби', 'slug' => 'tempura-ebi', 'short_description' => 'Креветка в темпуре', 'full_description' => 'Хрустящая креветка, авокадо, спайси соус'],
                    'ro' => ['name' => 'Tempura Ebi', 'slug' => 'tempura-ebi', 'short_description' => 'Crevetă în tempura', 'full_description' => 'Crevetă crocantă, avocado, sos spicy'],
                    'en' => ['name' => 'Ebi Tempura', 'slug' => 'ebi-tempura', 'short_description' => 'Shrimp tempura', 'full_description' => 'Crispy shrimp, avocado, spicy sauce']
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'TEMP002',
                'price' => 90.00,
                'translations' => [
                    'ru' => ['name' => 'Tempura Лосось', 'slug' => 'tempura-salmon', 'short_description' => 'Лосось в темпуре', 'full_description' => 'Жареный лосось, огурец, соус унаги'],
                    'ro' => ['name' => 'Tempura Somon', 'slug' => 'tempura-somon', 'short_description' => 'Somon în tempura', 'full_description' => 'Somon prăjit, castravete, sos unagi'],
                    'en' => ['name' => 'Salmon Tempura', 'slug' => 'salmon-tempura', 'short_description' => 'Salmon tempura', 'full_description' => 'Fried salmon, cucumber, unagi sauce']
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'TEMP003',
                'price' => 85.00,
                'translations' => [
                    'ru' => ['name' => 'Tempura Овощи', 'slug' => 'tempura-vegetables', 'short_description' => 'Вегетарианский', 'full_description' => 'Баклажан, тыква, перец в темпуре'],
                    'ro' => ['name' => 'Tempura Legume', 'slug' => 'tempura-legume', 'short_description' => 'Vegetarian', 'full_description' => 'Vânătă, dovleac, ardei în tempura'],
                    'en' => ['name' => 'Vegetable Tempura', 'slug' => 'vegetable-tempura', 'short_description' => 'Vegetarian', 'full_description' => 'Eggplant, pumpkin, pepper in tempura']
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'TEMP004',
                'price' => 98.00,
                'translations' => [
                    'ru' => ['name' => 'Tempura Микс', 'slug' => 'tempura-mix', 'short_description' => 'Креветка и рыба', 'full_description' => 'Креветка, лосось, авокадо в темпуре'],
                    'ro' => ['name' => 'Tempura Mix', 'slug' => 'tempura-mix', 'short_description' => 'Crevetă și pește', 'full_description' => 'Crevetă, somon, avocado în tempura'],
                    'en' => ['name' => 'Mix Tempura', 'slug' => 'mix-tempura', 'short_description' => 'Shrimp and fish', 'full_description' => 'Shrimp, salmon, avocado in tempura']
                ]
            ],
            [
                'category_id' => $categories['tempura']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'TEMP005',
                'price' => 92.00,
                'translations' => [
                    'ru' => ['name' => 'Tempura Спайси', 'slug' => 'tempura-spicy', 'short_description' => 'Острый жареный ролл', 'full_description' => 'Тунец, перец чили, спайси майонез'],
                    'ro' => ['name' => 'Tempura Spicy', 'slug' => 'tempura-spicy', 'short_description' => 'Roll picant prăjit', 'full_description' => 'Ton, ardei chili, maioneză spicy'],
                    'en' => ['name' => 'Spicy Tempura', 'slug' => 'spicy-tempura', 'short_description' => 'Spicy fried roll', 'full_description' => 'Tuna, chili pepper, spicy mayo']
                ]
            ],

            // ============ SASHIMI (5 шт) ============
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SASH001',
                'price' => 120.00,
                'translations' => [
                    'ru' => ['name' => 'Sashimi Лосось', 'slug' => 'sashimi-losos', 'short_description' => 'Классическое сашими', 'full_description' => '5 кусочков свежего лосося'],
                    'ro' => ['name' => 'Sashimi Somon', 'slug' => 'sashimi-somon', 'short_description' => 'Sashimi clasic', 'full_description' => '5 bucăți de somon proaspăt'],
                    'en' => ['name' => 'Salmon Sashimi', 'slug' => 'salmon-sashimi', 'short_description' => 'Classic sashimi', 'full_description' => '5 pieces of fresh salmon']
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SASH002',
                'price' => 135.00,
                'translations' => [
                    'ru' => ['name' => 'Sashimi Тунец', 'slug' => 'sashimi-tunec', 'short_description' => 'Премиум тунец', 'full_description' => '5 кусочков свежего тунца'],
                    'ro' => ['name' => 'Sashimi Ton', 'slug' => 'sashimi-ton', 'short_description' => 'Ton premium', 'full_description' => '5 bucăți de ton proaspăt'],
                    'en' => ['name' => 'Tuna Sashimi', 'slug' => 'tuna-sashimi', 'short_description' => 'Premium tuna', 'full_description' => '5 pieces of fresh tuna']
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SASH003',
                'price' => 150.00,
                'translations' => [
                    'ru' => ['name' => 'Sashimi Микс', 'slug' => 'sashimi-mix', 'short_description' => 'Ассорти из рыбы', 'full_description' => 'Лосось, тунец, окунь - по 3 кусочка'],
                    'ro' => ['name' => 'Sashimi Mix', 'slug' => 'sashimi-mix', 'short_description' => 'Sortiment de pește', 'full_description' => 'Somon, ton, biban - câte 3 bucăți'],
                    'en' => ['name' => 'Mix Sashimi', 'slug' => 'mix-sashimi', 'short_description' => 'Fish assortment', 'full_description' => 'Salmon, tuna, sea bass - 3 pcs each']
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SASH004',
                'price' => 140.00,
                'translations' => [
                    'ru' => ['name' => 'Sashimi Окунь', 'slug' => 'sashimi-okun', 'short_description' => 'Морской окунь', 'full_description' => '5 кусочков свежего окуня'],
                    'ro' => ['name' => 'Sashimi Biban', 'slug' => 'sashimi-biban', 'short_description' => 'Biban de mare', 'full_description' => '5 bucăți de biban proaspăt'],
                    'en' => ['name' => 'Sea Bass Sashimi', 'slug' => 'sea-bass-sashimi', 'short_description' => 'Sea bass', 'full_description' => '5 pieces of fresh sea bass']
                ]
            ],
            [
                'category_id' => $categories['sashimi']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SASH005',
                'price' => 160.00,
                'translations' => [
                    'ru' => ['name' => 'Sashimi Премиум', 'slug' => 'sashimi-premium', 'short_description' => 'Премиальная подача', 'full_description' => 'Лосось, тунец, гребешок, креветка'],
                    'ro' => ['name' => 'Sashimi Premium', 'slug' => 'sashimi-premium', 'short_description' => 'Servire premium', 'full_description' => 'Somon, ton, scoică, crevetă'],
                    'en' => ['name' => 'Premium Sashimi', 'slug' => 'premium-sashimi', 'short_description' => 'Premium serving', 'full_description' => 'Salmon, tuna, scallop, shrimp']
                ]
            ],

            // ============ SETS / СЕТЫ (5 шт) ============
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SET001',
                'price' => 250.00,
                'translations' => [
                    'ru' => ['name' => 'Сет для двоих', 'slug' => 'set-dlya-dvoih', 'short_description' => 'Идеальный набор на двоих', 'full_description' => '32 шт: Филадельфия, Калифорния, нигири'],
                    'ro' => ['name' => 'Set pentru doi', 'slug' => 'set-pentru-doi', 'short_description' => 'Set ideal pentru doi', 'full_description' => '32 buc: Philadelphia, California, nigiri'],
                    'en' => ['name' => 'Set for Two', 'slug' => 'set-for-two', 'short_description' => 'Perfect set for two', 'full_description' => '32 pcs: Philadelphia, California, nigiri']
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SET002',
                'price' => 450.00,
                'translations' => [
                    'ru' => ['name' => 'Сет Семейный', 'slug' => 'set-semejnyj', 'short_description' => 'Большой набор', 'full_description' => '64 шт: ассорти роллов и нигири'],
                    'ro' => ['name' => 'Set Familial', 'slug' => 'set-familial', 'short_description' => 'Set mare', 'full_description' => '64 buc: sortiment de roll-uri și nigiri'],
                    'en' => ['name' => 'Family Set', 'slug' => 'family-set', 'short_description' => 'Large set', 'full_description' => '64 pcs: assorted rolls and nigiri']
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SET003',
                'price' => 180.00,
                'translations' => [
                    'ru' => ['name' => 'Сет Вегетарианский', 'slug' => 'set-vegetarianskij', 'short_description' => 'Без рыбы и мяса', 'full_description' => '24 шт: овощные роллы и нигири'],
                    'ro' => ['name' => 'Set Vegetarian', 'slug' => 'set-vegetarian', 'short_description' => 'Fără pește și carne', 'full_description' => '24 buc: roll-uri și nigiri cu legume'],
                    'en' => ['name' => 'Vegetarian Set', 'slug' => 'vegetarian-set', 'short_description' => 'No fish or meat', 'full_description' => '24 pcs: vegetable rolls and nigiri']
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SET004',
                'price' => 320.00,
                'translations' => [
                    'ru' => ['name' => 'Сет Премиум', 'slug' => 'set-premium', 'short_description' => 'Лучшие позиции', 'full_description' => '40 шт: премиум роллы, сашими, нигири'],
                    'ro' => ['name' => 'Set Premium', 'slug' => 'set-premium', 'short_description' => 'Cele mai bune poziții', 'full_description' => '40 buc: roll-uri premium, sashimi, nigiri'],
                    'en' => ['name' => 'Premium Set', 'slug' => 'premium-set', 'short_description' => 'Best items', 'full_description' => '40 pcs: premium rolls, sashimi, nigiri']
                ]
            ],
            [
                'category_id' => $categories['sets']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'SET005',
                'price' => 220.00,
                'translations' => [
                    'ru' => ['name' => 'Сет Темпура', 'slug' => 'set-tempura', 'short_description' => 'Только жареные роллы', 'full_description' => '32 шт: ассорти темпура роллов'],
                    'ro' => ['name' => 'Set Tempura', 'slug' => 'set-tempura', 'short_description' => 'Doar roll-uri prăjite', 'full_description' => '32 buc: sortiment de roll-uri tempura'],
                    'en' => ['name' => 'Tempura Set', 'slug' => 'tempura-set', 'short_description' => 'Only fried rolls', 'full_description' => '32 pcs: assorted tempura rolls']
                ]
            ],

            // ============ SUNOMONO (5 шт) ============
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SUNO001',
                'price' => 45.00,
                'translations' => [
                    'ru' => ['name' => 'Sunomono Классический', 'slug' => 'sunomono-klassicheskij', 'short_description' => 'Огурец в уксусе', 'full_description' => 'Маринованный огурец с рисовым уксусом'],
                    'ro' => ['name' => 'Sunomono Clasic', 'slug' => 'sunomono-clasic', 'short_description' => 'Castravete în oțet', 'full_description' => 'Castravete marinat cu oțet de orez'],
                    'en' => ['name' => 'Classic Sunomono', 'slug' => 'classic-sunomono', 'short_description' => 'Cucumber in vinegar', 'full_description' => 'Marinated cucumber with rice vinegar']
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SUNO002',
                'price' => 55.00,
                'translations' => [
                    'ru' => ['name' => 'Sunomono Морепродукты', 'slug' => 'sunomono-moreprodukty', 'short_description' => 'С креветкой и кальмаром', 'full_description' => 'Огурец, креветка, кальмар в уксусе'],
                    'ro' => ['name' => 'Sunomono Fructe de mare', 'slug' => 'sunomono-fructe-mare', 'short_description' => 'Cu crevetă și calmar', 'full_description' => 'Castravete, crevetă, calmar în oțet'],
                    'en' => ['name' => 'Seafood Sunomono', 'slug' => 'seafood-sunomono', 'short_description' => 'With shrimp and squid', 'full_description' => 'Cucumber, shrimp, squid in vinegar']
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SUNO003',
                'price' => 50.00,
                'translations' => [
                    'ru' => ['name' => 'Sunomono Чука', 'slug' => 'sunomono-chuka', 'short_description' => 'С водорослями', 'full_description' => 'Огурец с салатом чука'],
                    'ro' => ['name' => 'Sunomono Chuka', 'slug' => 'sunomono-chuka', 'short_description' => 'Cu alge', 'full_description' => 'Castravete cu salată chuka'],
                    'en' => ['name' => 'Chuka Sunomono', 'slug' => 'chuka-sunomono', 'short_description' => 'With seaweed', 'full_description' => 'Cucumber with chuka salad']
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SUNO004',
                'price' => 60.00,
                'translations' => [
                    'ru' => ['name' => 'Sunomono Осьминог', 'slug' => 'sunomono-osminog', 'short_description' => 'С осьминогом', 'full_description' => 'Маринованный осьминог с огурцом'],
                    'ro' => ['name' => 'Sunomono Caracatiță', 'slug' => 'sunomono-caracatita', 'short_description' => 'Cu caracatiță', 'full_description' => 'Caracatiță marinată cu castravete'],
                    'en' => ['name' => 'Octopus Sunomono', 'slug' => 'octopus-sunomono', 'short_description' => 'With octopus', 'full_description' => 'Marinated octopus with cucumber']
                ]
            ],
            [
                'category_id' => $categories['sunomono']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SUNO005',
                'price' => 48.00,
                'translations' => [
                    'ru' => ['name' => 'Sunomono Микс', 'slug' => 'sunomono-mix', 'short_description' => 'Овощной микс', 'full_description' => 'Огурец, морковь, дайкон в уксусе'],
                    'ro' => ['name' => 'Sunomono Mix', 'slug' => 'sunomono-mix', 'short_description' => 'Mix de legume', 'full_description' => 'Castravete, morcov, daikon în oțet'],
                    'en' => ['name' => 'Mix Sunomono', 'slug' => 'mix-sunomono', 'short_description' => 'Vegetable mix', 'full_description' => 'Cucumber, carrot, daikon in vinegar']
                ]
            ],

            // ============ NOODLES / ЛАПША (5 шт) ============
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'NOOD001',
                'price' => 70.00,
                'translations' => [
                    'ru' => ['name' => 'Рамен Классический', 'slug' => 'ramen-klassicheskij', 'short_description' => 'Японский суп-лапша', 'full_description' => 'Лапша в бульоне с яйцом и овощами'],
                    'ro' => ['name' => 'Ramen Clasic', 'slug' => 'ramen-clasic', 'short_description' => 'Supă japoneză cu tăiței', 'full_description' => 'Tăiței în bulion cu ou și legume'],
                    'en' => ['name' => 'Classic Ramen', 'slug' => 'classic-ramen', 'short_description' => 'Japanese noodle soup', 'full_description' => 'Noodles in broth with egg and vegetables']
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'NOOD002',
                'price' => 85.00,
                'translations' => [
                    'ru' => ['name' => 'Рамен Морепродукты', 'slug' => 'ramen-moreprodukty', 'short_description' => 'С креветкой и кальмаром', 'full_description' => 'Лапша с морепродуктами в бульоне'],
                    'ro' => ['name' => 'Ramen Fructe de mare', 'slug' => 'ramen-fructe-mare', 'short_description' => 'Cu crevetă și calmar', 'full_description' => 'Tăiței cu fructe de mare în bulion'],
                    'en' => ['name' => 'Seafood Ramen', 'slug' => 'seafood-ramen', 'short_description' => 'With shrimp and squid', 'full_description' => 'Noodles with seafood in broth']
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'NOOD003',
                'price' => 65.00,
                'translations' => [
                    'ru' => ['name' => 'Удон Овощи', 'slug' => 'udon-ovoshchi', 'short_description' => 'Толстая лапша с овощами', 'full_description' => 'Удон с овощами в соевом соусе'],
                    'ro' => ['name' => 'Udon Legume', 'slug' => 'udon-legume', 'short_description' => 'Tăiței groși cu legume', 'full_description' => 'Udon cu legume în sos de soia'],
                    'en' => ['name' => 'Vegetable Udon', 'slug' => 'vegetable-udon', 'short_description' => 'Thick noodles with vegetables', 'full_description' => 'Udon with vegetables in soy sauce']
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'NOOD004',
                'price' => 80.00,
                'translations' => [
                    'ru' => ['name' => 'Соба Курица', 'slug' => 'soba-kurica', 'short_description' => 'Гречневая лапша', 'full_description' => 'Соба с курицей и овощами'],
                    'ro' => ['name' => 'Soba Pui', 'slug' => 'soba-pui', 'short_description' => 'Tăiței din hrișcă', 'full_description' => 'Soba cu pui și legume'],
                    'en' => ['name' => 'Chicken Soba', 'slug' => 'chicken-soba', 'short_description' => 'Buckwheat noodles', 'full_description' => 'Soba with chicken and vegetables']
                ]
            ],
            [
                'category_id' => $categories['noodles']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'NOOD005',
                'price' => 90.00,
                'translations' => [
                    'ru' => ['name' => 'Якисоба Микс', 'slug' => 'yakisoba-mix', 'short_description' => 'Жареная лапша', 'full_description' => 'Жареная лапша с мясом и морепродуктами'],
                    'ro' => ['name' => 'Yakisoba Mix', 'slug' => 'yakisoba-mix', 'short_description' => 'Tăiței prăjiți', 'full_description' => 'Tăiței prăjiți cu carne și fructe de mare'],
                    'en' => ['name' => 'Mix Yakisoba', 'slug' => 'mix-yakisoba', 'short_description' => 'Fried noodles', 'full_description' => 'Fried noodles with meat and seafood']
                ]
            ],

            // ============ RICE / РИС (5 шт) ============
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'RICE001',
                'price' => 55.00,
                'translations' => [
                    'ru' => ['name' => 'Рис Овощи', 'slug' => 'ris-ovoshchi', 'short_description' => 'Жареный рис с овощами', 'full_description' => 'Рис с овощным миксом'],
                    'ro' => ['name' => 'Orez Legume', 'slug' => 'orez-legume', 'short_description' => 'Orez prăjit cu legume', 'full_description' => 'Orez cu mix de legume'],
                    'en' => ['name' => 'Vegetable Rice', 'slug' => 'vegetable-rice', 'short_description' => 'Fried rice with vegetables', 'full_description' => 'Rice with vegetable mix']
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $salmonBrand->id,
                'sku' => 'RICE002',
                'price' => 65.00,
                'translations' => [
                    'ru' => ['name' => 'Рис Курица', 'slug' => 'ris-kurica', 'short_description' => 'Рис с курицей терияки', 'full_description' => 'Жареный рис с курицей в соусе терияки'],
                    'ro' => ['name' => 'Orez Pui', 'slug' => 'orez-pui', 'short_description' => 'Orez cu pui teriyaki', 'full_description' => 'Orez prăjit cu pui în sos teriyaki'],
                    'en' => ['name' => 'Chicken Rice', 'slug' => 'chicken-rice', 'short_description' => 'Rice with teriyaki chicken', 'full_description' => 'Fried rice with chicken in teriyaki sauce']
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'RICE003',
                'price' => 75.00,
                'translations' => [
                    'ru' => ['name' => 'Рис Креветки', 'slug' => 'ris-krevetki', 'short_description' => 'Рис с королевскими креветками', 'full_description' => 'Жареный рис с креветками и яйцом'],
                    'ro' => ['name' => 'Orez Creveți', 'slug' => 'orez-creveti', 'short_description' => 'Orez cu creveți regali', 'full_description' => 'Orez prăjit cu creveți și ou'],
                    'en' => ['name' => 'Shrimp Rice', 'slug' => 'shrimp-rice', 'short_description' => 'Rice with king shrimp', 'full_description' => 'Fried rice with shrimp and egg']
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'RICE004',
                'price' => 50.00,
                'translations' => [
                    'ru' => ['name' => 'Рис Яйцо', 'slug' => 'ris-yajco', 'short_description' => 'Простой жареный рис', 'full_description' => 'Жареный рис с яйцом и зелёным луком'],
                    'ro' => ['name' => 'Orez Ou', 'slug' => 'orez-ou', 'short_description' => 'Orez prăjit simplu', 'full_description' => 'Orez prăjit cu ou și ceapă verde'],
                    'en' => ['name' => 'Egg Rice', 'slug' => 'egg-rice', 'short_description' => 'Simple fried rice', 'full_description' => 'Fried rice with egg and green onion']
                ]
            ],
            [
                'category_id' => $categories['rice']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'RICE005',
                'price' => 80.00,
                'translations' => [
                    'ru' => ['name' => 'Рис Микс', 'slug' => 'ris-mix', 'short_description' => 'Рис с мясом и морепродуктами', 'full_description' => 'Жареный рис с курицей, креветками и овощами'],
                    'ro' => ['name' => 'Orez Mix', 'slug' => 'orez-mix', 'short_description' => 'Orez cu carne și fructe de mare', 'full_description' => 'Orez prăjit cu pui, creveți și legume'],
                    'en' => ['name' => 'Mix Rice', 'slug' => 'mix-rice', 'short_description' => 'Rice with meat and seafood', 'full_description' => 'Fried rice with chicken, shrimp and vegetables']
                ]
            ],

            // ============ SOUP / СУП (5 шт) ============
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SOUP001',
                'price' => 40.00,
                'translations' => [
                    'ru' => ['name' => 'Мисо Суп', 'slug' => 'miso-sup', 'short_description' => 'Традиционный японский суп', 'full_description' => 'Суп на основе мисо-пасты с тофу'],
                    'ro' => ['name' => 'Supă Miso', 'slug' => 'supa-miso', 'short_description' => 'Supă japoneză tradițională', 'full_description' => 'Supă pe bază de pastă miso cu tofu'],
                    'en' => ['name' => 'Miso Soup', 'slug' => 'miso-soup', 'short_description' => 'Traditional Japanese soup', 'full_description' => 'Soup based on miso paste with tofu']
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SOUP002',
                'price' => 55.00,
                'translations' => [
                    'ru' => ['name' => 'Том Ям', 'slug' => 'tom-yam', 'short_description' => 'Острый тайский суп', 'full_description' => 'Кисло-острый суп с креветками'],
                    'ro' => ['name' => 'Tom Yam', 'slug' => 'tom-yam', 'short_description' => 'Supă thailandeză picantă', 'full_description' => 'Supă acru-picantă cu creveți'],
                    'en' => ['name' => 'Tom Yam', 'slug' => 'tom-yam', 'short_description' => 'Spicy Thai soup', 'full_description' => 'Sour-spicy soup with shrimp']
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SOUP003',
                'price' => 45.00,
                'translations' => [
                    'ru' => ['name' => 'Суп с Тофу', 'slug' => 'sup-tofu', 'short_description' => 'Вегетарианский суп', 'full_description' => 'Лёгкий суп с тофу и овощами'],
                    'ro' => ['name' => 'Supă cu Tofu', 'slug' => 'supa-tofu', 'short_description' => 'Supă vegetariană', 'full_description' => 'Supă ușoară cu tofu și legume'],
                    'en' => ['name' => 'Tofu Soup', 'slug' => 'tofu-soup', 'short_description' => 'Vegetarian soup', 'full_description' => 'Light soup with tofu and vegetables']
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'SOUP004',
                'price' => 60.00,
                'translations' => [
                    'ru' => ['name' => 'Суп Морепродукты', 'slug' => 'sup-moreprodukty', 'short_description' => 'Суп с дарами моря', 'full_description' => 'Суп с креветками, кальмаром и мидиями'],
                    'ro' => ['name' => 'Supă Fructe de mare', 'slug' => 'supa-fructe-mare', 'short_description' => 'Supă cu daruri ale mării', 'full_description' => 'Supă cu creveți, calmar și midii'],
                    'en' => ['name' => 'Seafood Soup', 'slug' => 'seafood-soup', 'short_description' => 'Soup with seafood', 'full_description' => 'Soup with shrimp, squid and mussels']
                ]
            ],
            [
                'category_id' => $categories['soup']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'SOUP005',
                'price' => 50.00,
                'translations' => [
                    'ru' => ['name' => 'Куриный Рамен', 'slug' => 'kurinyj-ramen', 'short_description' => 'Суп с курицей', 'full_description' => 'Бульон с лапшой и куриным филе'],
                    'ro' => ['name' => 'Ramen de Pui', 'slug' => 'ramen-pui', 'short_description' => 'Supă cu pui', 'full_description' => 'Bulion cu tăiței și file de pui'],
                    'en' => ['name' => 'Chicken Ramen', 'slug' => 'chicken-ramen', 'short_description' => 'Soup with chicken', 'full_description' => 'Broth with noodles and chicken fillet']
                ]
            ],

            // ============ DRINKS / НАПИТКИ (5 шт) ============
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'DRINK001',
                'price' => 25.00,
                'translations' => [
                    'ru' => ['name' => 'Зелёный Чай', 'slug' => 'zelyonyj-chaj', 'short_description' => 'Традиционный японский чай', 'full_description' => 'Горячий зелёный чай сенча'],
                    'ro' => ['name' => 'Ceai Verde', 'slug' => 'ceai-verde', 'short_description' => 'Ceai japonez tradițional', 'full_description' => 'Ceai verde sencha fierbinte'],
                    'en' => ['name' => 'Green Tea', 'slug' => 'green-tea', 'short_description' => 'Traditional Japanese tea', 'full_description' => 'Hot sencha green tea']
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'DRINK002',
                'price' => 35.00,
                'translations' => [
                    'ru' => ['name' => 'Саке', 'slug' => 'sake', 'short_description' => 'Рисовое вино', 'full_description' => 'Традиционное японское саке 300мл'],
                    'ro' => ['name' => 'Sake', 'slug' => 'sake', 'short_description' => 'Vin de orez', 'full_description' => 'Sake japonez tradițional 300ml'],
                    'en' => ['name' => 'Sake', 'slug' => 'sake', 'short_description' => 'Rice wine', 'full_description' => 'Traditional Japanese sake 300ml']
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'DRINK003',
                'price' => 20.00,
                'translations' => [
                    'ru' => ['name' => 'Кока-Кола', 'slug' => 'coca-cola', 'short_description' => 'Газированный напиток', 'full_description' => 'Кока-Кола 330мл'],
                    'ro' => ['name' => 'Coca-Cola', 'slug' => 'coca-cola', 'short_description' => 'Băutură carbogazoasă', 'full_description' => 'Coca-Cola 330ml'],
                    'en' => ['name' => 'Coca-Cola', 'slug' => 'coca-cola', 'short_description' => 'Carbonated drink', 'full_description' => 'Coca-Cola 330ml']
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $riceBrand->id,
                'sku' => 'DRINK004',
                'price' => 30.00,
                'translations' => [
                    'ru' => ['name' => 'Лимонад Юдзу', 'slug' => 'limonad-yuzu', 'short_description' => 'Японский цитрусовый лимонад', 'full_description' => 'Освежающий лимонад с юдзу'],
                    'ro' => ['name' => 'Limonadă Yuzu', 'slug' => 'limonada-yuzu', 'short_description' => 'Limonadă japoneză cu citrice', 'full_description' => 'Limonadă revigorantă cu yuzu'],
                    'en' => ['name' => 'Yuzu Lemonade', 'slug' => 'yuzu-lemonade', 'short_description' => 'Japanese citrus lemonade', 'full_description' => 'Refreshing yuzu lemonade']
                ]
            ],
            [
                'category_id' => $categories['drinks']->id,
                'brand_id' => $oceanBrand->id,
                'sku' => 'DRINK005',
                'price' => 28.00,
                'translations' => [
                    'ru' => ['name' => 'Асахи Пиво', 'slug' => 'asahi-pivo', 'short_description' => 'Японское пиво', 'full_description' => 'Asahi Super Dry 330мл'],
                    'ro' => ['name' => 'Asahi Bere', 'slug' => 'asahi-bere', 'short_description' => 'Bere japoneză', 'full_description' => 'Asahi Super Dry 330ml'],
                    'en' => ['name' => 'Asahi Beer', 'slug' => 'asahi-beer', 'short_description' => 'Japanese beer', 'full_description' => 'Asahi Super Dry 330ml']
                ]
            ],
        ];

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

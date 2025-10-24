<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductImage;

class ProductSeederHosomaki extends Seeder
{
    public function run(): void
    {
        // ========== ТОВАР 1: KAPA HOSOMAKI ==========
        $product1 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'KAPA-HOSOMAKI',
            'price' => 55.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ru',
            'name' => 'KAPA HOSOMAKI',
            'slug' => 'kapa-hosomaki',
            'short_description' => 'Освежающие хосомаки с хрустящим огурцом',
            'full_description' => 'Классические хосомаки с рисом и свежим огурцом. Идеальный выбор для любителей простых и натуральных вкусов.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'ro',
            'name' => 'KAPA HOSOMAKI',
            'slug' => 'kapa-hosomaki',
            'short_description' => 'Hosomaki proaspete cu castravete crocant',
            'full_description' => 'Hosomaki clasice cu orez și castravete proaspăt. Alegerea perfectă pentru iubitorii de gusturi simple și naturale.',
        ]);

        ProductTranslation::create([
            'product_id' => $product1->id,
            'language' => 'en',
            'name' => 'KAPA HOSOMAKI',
            'slug' => 'kapa-hosomaki',
            'short_description' => 'Refreshing hosomaki with crispy cucumber',
            'full_description' => 'Classic hosomaki with rice and fresh cucumber. Perfect choice for lovers of simple and natural flavors.',
        ]);

        ProductImage::create([
            'product_id' => $product1->id,
            'path' => 'products/kapa-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 2: AVO HOSOMAKI ==========
        $product2 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'AVO-HOSOMAKI',
            'price' => 70.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ru',
            'name' => 'AVO HOSOMAKI',
            'slug' => 'avo-hosomaki',
            'short_description' => 'Нежные хосомаки с кремовым авокадо',
            'full_description' => 'Классические хосомаки с рисом и спелым авокадо. Мягкая текстура и насыщенный вкус для истинных гурманов.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'ro',
            'name' => 'AVO HOSOMAKI',
            'slug' => 'avo-hosomaki',
            'short_description' => 'Hosomaki delicate cu avocado cremos',
            'full_description' => 'Hosomaki clasice cu orez și avocado copt. Textură moale și gust bogat pentru adevărații gurmani.',
        ]);

        ProductTranslation::create([
            'product_id' => $product2->id,
            'language' => 'en',
            'name' => 'AVO HOSOMAKI',
            'slug' => 'avo-hosomaki',
            'short_description' => 'Delicate hosomaki with creamy avocado',
            'full_description' => 'Classic hosomaki with rice and ripe avocado. Soft texture and rich taste for true gourmets.',
        ]);

        ProductImage::create([
            'product_id' => $product2->id,
            'path' => 'products/avo-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 3: CREM HOSOMAKI ==========
        $product3 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'CREM-HOSOMAKI',
            'price' => 65.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ru',
            'name' => 'CREM HOSOMAKI',
            'slug' => 'crem-hosomaki',
            'short_description' => 'Классические хосомаки с нежным сливочным сыром',
            'full_description' => 'Изысканные хосомаки с рисом и кремовым сыром. Мягкий вкус и воздушная текстура в каждом кусочке.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'ro',
            'name' => 'CREM HOSOMAKI',
            'slug' => 'crem-hosomaki',
            'short_description' => 'Hosomaki clasice cu brânză cremoasă delicată',
            'full_description' => 'Hosomaki rafinate cu orez și brânză cremoasă. Gust moale și textură aerisită în fiecare bucată.',
        ]);

        ProductTranslation::create([
            'product_id' => $product3->id,
            'language' => 'en',
            'name' => 'CREM HOSOMAKI',
            'slug' => 'crem-hosomaki',
            'short_description' => 'Classic hosomaki with delicate cream cheese',
            'full_description' => 'Exquisite hosomaki with rice and cream cheese. Soft taste and airy texture in every bite.',
        ]);

        ProductImage::create([
            'product_id' => $product3->id,
            'path' => 'products/crem-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 4: WAKAME HOSOMAKI ==========
        $product4 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'WAKAME-HOSOMAKI',
            'price' => 75.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ru',
            'name' => 'WAKAME HOSOMAKI',
            'slug' => 'wakame-hosomaki',
            'short_description' => 'Полезные хосомаки с морскими водорослями вакаме',
            'full_description' => 'Традиционные хосомаки с рисом и водорослями вакаме. Богатый минералами вкус моря в каждом кусочке.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'ro',
            'name' => 'WAKAME HOSOMAKI',
            'slug' => 'wakame-hosomaki',
            'short_description' => 'Hosomaki sănătoase cu alge marine wakame',
            'full_description' => 'Hosomaki tradiționale cu orez și alge wakame. Gust bogat în minerale al mării în fiecare bucată.',
        ]);

        ProductTranslation::create([
            'product_id' => $product4->id,
            'language' => 'en',
            'name' => 'WAKAME HOSOMAKI',
            'slug' => 'wakame-hosomaki',
            'short_description' => 'Healthy hosomaki with wakame seaweed',
            'full_description' => 'Traditional hosomaki with rice and wakame seaweed. Mineral-rich taste of the sea in every bite.',
        ]);

        ProductImage::create([
            'product_id' => $product4->id,
            'path' => 'products/wakame-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 5: MAGURO HOSOMAKI ==========
        $product5 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'MAGURO-HOSOMAKI',
            'price' => 90.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ru',
            'name' => 'MAGURO HOSOMAKI',
            'slug' => 'maguro-hosomaki',
            'short_description' => 'Изысканные хосомаки с нежным тунцом',
            'full_description' => 'Премиальные хосомаки с рисом и свежим тунцом. Насыщенный вкус океана для истинных ценителей.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'ro',
            'name' => 'MAGURO HOSOMAKI',
            'slug' => 'maguro-hosomaki',
            'short_description' => 'Hosomaki rafinate cu ton delicat',
            'full_description' => 'Hosomaki premium cu orez și ton proaspăt. Gust bogat al oceanului pentru adevărații cunoscători.',
        ]);

        ProductTranslation::create([
            'product_id' => $product5->id,
            'language' => 'en',
            'name' => 'MAGURO HOSOMAKI',
            'slug' => 'maguro-hosomaki',
            'short_description' => 'Exquisite hosomaki with delicate tuna',
            'full_description' => 'Premium hosomaki with rice and fresh tuna. Rich ocean taste for true connoisseurs.',
        ]);

        ProductImage::create([
            'product_id' => $product5->id,
            'path' => 'products/maguro-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 6: SHAKE HOSOMAKI ==========
        $product6 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'SHAKE-HOSOMAKI',
            'price' => 110.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ru',
            'name' => 'SHAKE HOSOMAKI',
            'slug' => 'shake-hosomaki',
            'short_description' => 'Роскошные хосомаки с нежнейшим лососем',
            'full_description' => 'Классические хосомаки с рисом и свежим лососем. Деликатный вкус и тающая текстура для гурманов.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'ro',
            'name' => 'SHAKE HOSOMAKI',
            'slug' => 'shake-hosomaki',
            'short_description' => 'Hosomaki luxoase cu somon delicat',
            'full_description' => 'Hosomaki clasice cu orez și somon proaspăt. Gust delicat și textură topitoare pentru gurmani.',
        ]);

        ProductTranslation::create([
            'product_id' => $product6->id,
            'language' => 'en',
            'name' => 'SHAKE HOSOMAKI',
            'slug' => 'shake-hosomaki',
            'short_description' => 'Luxurious hosomaki with delicate salmon',
            'full_description' => 'Classic hosomaki with rice and fresh salmon. Delicate taste and melting texture for gourmets.',
        ]);

        ProductImage::create([
            'product_id' => $product6->id,
            'path' => 'products/shake-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 7: EBI HOSOMAKI ==========
        $product7 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'EBI-HOSOMAKI',
            'price' => 100.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 7,
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ru',
            'name' => 'EBI HOSOMAKI',
            'slug' => 'ebi-hosomaki',
            'short_description' => 'Аппетитные хосомаки со свежей креветкой',
            'full_description' => 'Традиционные хосомаки с рисом и сочной креветкой. Нежный морской вкус в каждом кусочке.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'ro',
            'name' => 'EBI HOSOMAKI',
            'slug' => 'ebi-hosomaki',
            'short_description' => 'Hosomaki apetisante cu crevete proaspete',
            'full_description' => 'Hosomaki tradiționale cu orez și crevete suculente. Gust marin delicat în fiecare bucată.',
        ]);

        ProductTranslation::create([
            'product_id' => $product7->id,
            'language' => 'en',
            'name' => 'EBI HOSOMAKI',
            'slug' => 'ebi-hosomaki',
            'short_description' => 'Appetizing hosomaki with fresh shrimp',
            'full_description' => 'Traditional hosomaki with rice and juicy shrimp. Delicate sea flavor in every bite.',
        ]);

        ProductImage::create([
            'product_id' => $product7->id,
            'path' => 'products/ebi-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);

        // ========== ТОВАР 8: UNAGHI HOSOMAKI ==========
        $product8 = Product::create([
            'brand_id' => 1,
            'category_id' => 3, // HOSOMAKI
            'sku' => 'UNAGHI-HOSOMAKI',
            'price' => 135.00,
            'currency' => 'MDL',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ru',
            'name' => 'UNAGHI HOSOMAKI',
            'slug' => 'unaghi-hosomaki',
            'short_description' => 'Премиальные хосомаки с копченым угрем',
            'full_description' => 'Эксклюзивные хосомаки с рисом и нежным копченым угрем. Глубокий насыщенный вкус для настоящих ценителей.',
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'ro',
            'name' => 'UNAGHI HOSOMAKI',
            'slug' => 'unaghi-hosomaki',
            'short_description' => 'Hosomaki premium cu anghilă afumată',
            'full_description' => 'Hosomaki exclusive cu orez și anghilă afumată delicată. Gust profund și bogat pentru adevărații cunoscători.',
        ]);

        ProductTranslation::create([
            'product_id' => $product8->id,
            'language' => 'en',
            'name' => 'UNAGHI HOSOMAKI',
            'slug' => 'unaghi-hosomaki',
            'short_description' => 'Premium hosomaki with smoked eel',
            'full_description' => 'Exclusive hosomaki with rice and delicate smoked eel. Deep rich flavor for true connoisseurs.',
        ]);

        ProductImage::create([
            'product_id' => $product8->id,
            'path' => 'products/unaghi-hosomaki.jpg',
            'is_main' => true,
            'sort_order' => 1,
        ]);
    }
}

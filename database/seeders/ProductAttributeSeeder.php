<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем атрибуты по правильным названиям
        $compositionAttr = ProductAttribute::whereHas('translation', function ($q) {
            $q->where('language', 'ru')->where('name', 'СОСТАВ');
        })->first();

        $piecesAttr = ProductAttribute::whereHas('translation', function ($q) {
            $q->where('language', 'ru')->where('name', 'КОЛИЧЕСТВО');
        })->first();

        $weightAttr = ProductAttribute::whereHas('translation', function ($q) {
            $q->where('language', 'ru')->where('name', 'ВЕС');
        })->first();

        // Проверяем, что атрибуты найдены
        if (!$compositionAttr || !$piecesAttr || !$weightAttr) {
            $this->command->error('Не все атрибуты найдены! Запустите AttributeSeeder сначала.');
            return;
        }

        // ========== ТОВАР 1: KAPA HOSOMAKI ==========
        $product1 = Product::where('sku', 'KAPA-HOSOMAKI')->first();

        if ($product1) {
            // Состав: Рис, Огурец
            $this->attachIngredients($product1, $compositionAttr, ['Рис', 'Огурец']);

            // Количество: 8 шт
            $this->attachValue($product1, $piecesAttr, '8 шт');

            // Вес: 210 г
            $this->attachValue($product1, $weightAttr, '210 г');
        }

        // ========== ТОВАР 2: AVO HOSOMAKI ==========
        $product2 = Product::where('sku', 'AVO-HOSOMAKI')->first();

        if ($product2) {
            $this->attachIngredients($product2, $compositionAttr, ['Рис', 'Авокадо']);
            $this->attachValue($product2, $piecesAttr, '8 шт');
            $this->attachValue($product2, $weightAttr, '210 г');
        }

        // ========== ТОВАР 3: CREM HOSOMAKI ==========
        $product3 = Product::where('sku', 'CREM-HOSOMAKI')->first();

        if ($product3) {
            $this->attachIngredients($product3, $compositionAttr, ['Рис', 'Сыр']);
            $this->attachValue($product3, $piecesAttr, '8 шт');
            $this->attachValue($product3, $weightAttr, '210 г');
        }

        // ========== ТОВАР 4: WAKAME HOSOMAKI ==========
        $product4 = Product::where('sku', 'WAKAME-HOSOMAKI')->first();

        if ($product4) {
            $this->attachIngredients($product4, $compositionAttr, ['Рис', 'Водоросли']);
            $this->attachValue($product4, $piecesAttr, '8 шт');
            $this->attachValue($product4, $weightAttr, '210 г');
        }

        // ========== ТОВАР 5: MAGURO HOSOMAKI ==========
        $product5 = Product::where('sku', 'MAGURO-HOSOMAKI')->first();

        if ($product5) {
            $this->attachIngredients($product5, $compositionAttr, ['Рис', 'Тунец']);
            $this->attachValue($product5, $piecesAttr, '8 шт');
            $this->attachValue($product5, $weightAttr, '210 г');
        }

        // ========== ТОВАР 6: SHAKE HOSOMAKI ==========
        $product6 = Product::where('sku', 'SHAKE-HOSOMAKI')->first();

        if ($product6) {
            $this->attachIngredients($product6, $compositionAttr, ['Рис', 'Лосось']);
            $this->attachValue($product6, $piecesAttr, '8 шт');
            $this->attachValue($product6, $weightAttr, '210 г');
        }

        // ========== ТОВАР 7: EBI HOSOMAKI ==========
        $product7 = Product::where('sku', 'EBI-HOSOMAKI')->first();

        if ($product7) {
            $this->attachIngredients($product7, $compositionAttr, ['Рис', 'Креветка']);
            $this->attachValue($product7, $piecesAttr, '8 шт');
            $this->attachValue($product7, $weightAttr, '210 г');
        }

        // ========== ТОВАР 8: UNAGHI HOSOMAKI ==========
        $product8 = Product::where('sku', 'UNAGHI-HOSOMAKI')->first();

        if ($product8) {
            $this->attachIngredients($product8, $compositionAttr, ['Рис', 'Угорь']);
            $this->attachValue($product8, $piecesAttr, '8 шт');
            $this->attachValue($product8, $weightAttr, '210 г');
        }
    }

    /**
     * Вспомогательный метод для привязки ингредиентов
     */
    private function attachIngredients($product, $attribute, array $ingredients)
    {
        foreach ($ingredients as $ingredientName) {
            $value = AttributeValue::whereHas('translations', function ($q) use ($ingredientName) {
                $q->where('language', 'ru')->where('value', $ingredientName);
            })->where('attribute_id', $attribute->id)->first();

            if ($value) {
                DB::table('product_attribute_values')->insertOrIgnore([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute->id,
                    'attribute_value_id' => $value->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Вспомогательный метод для привязки одного значения
     */
    private function attachValue($product, $attribute, $value_text)
    {
        $value = AttributeValue::whereHas('translations', function ($q) use ($value_text) {
            $q->where('language', 'ru')->where('value', $value_text);
        })->where('attribute_id', $attribute->id)->first();

        if ($value) {
            DB::table('product_attribute_values')->insertOrIgnore([
                'product_id' => $product->id,
                'attribute_id' => $attribute->id,
                'attribute_value_id' => $value->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

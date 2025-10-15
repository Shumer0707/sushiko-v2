<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // ========== АТРИБУТ 1: РАЗМЕР ПОРЦИИ ==========
        $sizeAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => 'шт',
            'is_filterable' => true,
            'is_variant' => true, // влияет на варианты товара (цена может меняться)
            'sort_order' => 1
        ]);

        // Переводы названия атрибута "Размер"
        AttributeTranslation::create([
            'attribute_id' => $sizeAttr->id,
            'language' => 'ru',
            'name' => 'РАЗМЕР'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $sizeAttr->id,
            'language' => 'ro',
            'name' => 'MĂRIME'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $sizeAttr->id,
            'language' => 'en',
            'name' => 'SIZE'
        ]);

        // Значения для размера
        $sizeValues = [
            ['ru' => 'МАЛЕНЬКИЙ (6 ШТ)', 'ro' => 'MIC (6 BUC)', 'en' => 'SMALL (6 PCS)'],
            ['ru' => 'СРЕДНИЙ (8 ШТ)', 'ro' => 'MEDIU (8 BUC)', 'en' => 'MEDIUM (8 PCS)'],
            ['ru' => 'БОЛЬШОЙ (10 ШТ)', 'ro' => 'MARE (10 BUC)', 'en' => 'LARGE (10 PCS)']
        ];

        foreach ($sizeValues as $index => $valueData) {
            // Создаём значение атрибута
            $value = AttributeValue::create([
                'attribute_id' => $sizeAttr->id,
                'sort_order' => $index + 1
            ]);

            // Переводы для каждого значения
            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }

        // ========== АТРИБУТ 2: ОСТРОТА ==========
        $spicyAttr = ProductAttribute::create([
            'type' => 'select',
            'unit' => null,
            'is_filterable' => true,
            'is_variant' => false, // не влияет на варианты, только для фильтрации
            'sort_order' => 2
        ]);

        // Переводы названия атрибута "Острота"
        AttributeTranslation::create([
            'attribute_id' => $spicyAttr->id,
            'language' => 'ru',
            'name' => 'ОСТРОТА'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $spicyAttr->id,
            'language' => 'ro',
            'name' => 'PICANT'
        ]);
        AttributeTranslation::create([
            'attribute_id' => $spicyAttr->id,
            'language' => 'en',
            'name' => 'SPICINESS'
        ]);

        // Значения для остроты
        $spicyValues = [
            ['ru' => 'НЕОСТРОЕ', 'ro' => 'NU E PICANT', 'en' => 'MILD'],
            ['ru' => 'СРЕДНЕ-ОСТРОЕ', 'ro' => 'MEDIU PICANT', 'en' => 'MEDIUM SPICY'],
            ['ru' => 'ОЧЕНЬ ОСТРОЕ', 'ro' => 'FOARTE PICANT', 'en' => 'VERY SPICY']
        ];

        foreach ($spicyValues as $index => $valueData) {
            // Создаём значение атрибута
            $value = AttributeValue::create([
                'attribute_id' => $spicyAttr->id,
                'sort_order' => $index + 1
            ]);

            // Переводы для каждого значения
            foreach ($valueData as $lang => $text) {
                AttributeValueTranslation::create([
                    'attribute_value_id' => $value->id,
                    'language' => $lang,
                    'value' => $text
                ]);
            }
        }
    }
}

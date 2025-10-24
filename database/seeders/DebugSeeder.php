<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;

class DebugSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('=== ПРОВЕРКА АТРИБУТОВ ===');

        // Проверяем количество атрибутов
        $attributeCount = ProductAttribute::count();
        $this->command->info("Всего атрибутов в базе: {$attributeCount}");

        // Проверяем все атрибуты с переводами
        $attributes = ProductAttribute::with('translations')->get();

        foreach ($attributes as $attr) {
            $this->command->info("\n📦 Атрибут ID: {$attr->id}");
            $this->command->info("  Тип: {$attr->type}");
            $this->command->info("  Единица: {$attr->unit}");
            $this->command->info("  Переводы:");

            foreach ($attr->translations as $trans) {
                $this->command->info("    [{$trans->language}]: {$trans->name}");
            }

            // Проверяем значения атрибута
            $values = AttributeValue::where('attribute_id', $attr->id)->with('translations')->get();
            $this->command->info("  Значения ({$values->count()}):");

            foreach ($values as $val) {
                $ruTrans = $val->translations->where('language', 'ru')->first();
                if ($ruTrans) {
                    $this->command->info("    - {$ruTrans->value}");
                }
            }
        }

        $this->command->info("\n=== ПРОВЕРКА ПЕРЕВОДОВ ===");

        // Проверяем русские переводы атрибутов
        $ruTranslations = AttributeTranslation::where('language', 'ru')->get();
        $this->command->info("Русские переводы атрибутов:");
        foreach ($ruTranslations as $trans) {
            $this->command->info("  - Атрибут ID {$trans->attribute_id}: {$trans->name}");
        }

        $this->command->info("\n=== ТЕСТ ПОИСКА ===");

        // Пробуем найти атрибуты
        $testNames = ['СОСТАВ', 'КОЛИЧЕСТВО', 'ВЕС'];

        foreach ($testNames as $name) {
            $attr = ProductAttribute::whereHas('translations', function ($q) use ($name) {
                $q->where('language', 'ru')->where('name', $name);
            })->first();

            if ($attr) {
                $this->command->info("✅ Найден атрибут '{$name}' с ID: {$attr->id}");
            } else {
                $this->command->error("❌ НЕ найден атрибут '{$name}'");

                // Пробуем альтернативный поиск
                $altAttr = AttributeTranslation::where('language', 'ru')
                    ->where('name', 'LIKE', "%{$name}%")
                    ->first();

                if ($altAttr) {
                    $this->command->warn("  Но найден похожий: '{$altAttr->name}' (ID атрибута: {$altAttr->attribute_id})");
                }
            }
        }
    }
}

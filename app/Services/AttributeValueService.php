<?php

namespace App\Services;

use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use Illuminate\Support\Facades\DB;

class AttributeValueService
{
    /**
     * Список значений по атрибуту (с переводами)
     */
    public function listByAttribute(int $attributeId)
    {
        return AttributeValue::with(['translations', 'translation'])
            ->where('attribute_id', $attributeId)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Создать значение для атрибута
     */
    public function create(int $attributeId, array $data): AttributeValue
    {
        return DB::transaction(function () use ($attributeId, $data) {
            $value = AttributeValue::create([
                'attribute_id' => $attributeId,
                'sort_order'   => $data['sort_order'] ?? 0,
            ]);

            $this->upsertTranslations($value, $data['translations'] ?? []);

            return $value->load(['translations', 'translation']);
        });
    }

    /**
     * Обновить значение
     */
    public function update(AttributeValue $value, array $data): AttributeValue
    {
        return DB::transaction(function () use ($value, $data) {
            if (array_key_exists('sort_order', $data)) {
                $value->sort_order = (int) $data['sort_order'];
                $value->save();
            }

            if (!empty($data['translations'])) {
                $this->upsertTranslations($value, $data['translations']);
            }

            return $value->load(['translations', 'translation']);
        });
    }

    /**
     * Удалить значение (detach произойдёт каскадно по FK, если настроено)
     */
    public function delete(AttributeValue $value): void
    {
        DB::transaction(function () use ($value) {
            $value->delete();
        });
    }

    /* ----------------- Helpers ----------------- */

    private function upsertTranslations(AttributeValue $value, array $translations): void
    {
        foreach (['ru', 'ro', 'en'] as $lang) {
            AttributeValueTranslation::updateOrCreate(
                ['attribute_value_id' => $value->id, 'language' => $lang],
                ['value' => $translations[$lang] ?? '']
            );
        }
    }
}

<?php

namespace App\Services;

use App\Models\ProductAttribute;
use App\Models\AttributeTranslation;
use Illuminate\Support\Facades\DB;

class AttributeService
{
    public function store(array $data): ProductAttribute
    {
        return DB::transaction(function () use ($data) {
            $attribute = ProductAttribute::create([
                'type' => $data['type'],
                'unit' => $data['unit'] ?? null,
                'is_filterable' => $data['is_filterable'] ?? false,
                'is_variant' => $data['is_variant'] ?? false,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            foreach (['ru', 'ro', 'en'] as $lang) {
                AttributeTranslation::create([
                    'attribute_id' => $attribute->id,
                    'language' => $lang,
                    'name' => $data['translations'][$lang],
                ]);
            }

            return $attribute;
        });
    }

    public function update(ProductAttribute $attribute, array $data): ProductAttribute
    {
        return DB::transaction(function () use ($attribute, $data) {
            $attribute->update([
                'type' => $data['type'],
                'unit' => $data['unit'] ?? null,
                'is_filterable' => $data['is_filterable'] ?? false,
                'is_variant' => $data['is_variant'] ?? false,
                'sort_order' => $data['sort_order'] ?? 0,
            ]);

            foreach (['ru', 'ro', 'en'] as $lang) {
                $attribute->translations()
                    ->updateOrCreate(
                        ['language' => $lang],
                        ['name' => $data['translations'][$lang]]
                    );
            }

            return $attribute;
        });
    }
}

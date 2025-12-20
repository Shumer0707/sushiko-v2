<?php

namespace App\Services;

use App\Models\Promotion;

class PromotionService
{
    public function create(array $data): Promotion
    {
        $data = $this->normalize($data);

        return Promotion::create($data);
    }

    public function update(Promotion $promotion, array $data): Promotion
    {
        $data = $this->normalize($data);

        $promotion->update($data);

        return $promotion->fresh();
    }

    /**
     * Приводим данные в консистентный вид по типу акции.
     */
    private function normalize(array $data): array
    {
        // дефолты (на случай если чекбокс не пришёл)
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['priority']  = (int) ($data['priority'] ?? 100);

        if (($data['type'] ?? null) === 'discount') {
            $data['gift_product_id'] = null;
            $data['gift_quantity']   = null;
        }

        if (($data['type'] ?? null) === 'gift') {
            $data['discount_price'] = null;
        }

        return $data;
    }
}

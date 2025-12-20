<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Carbon;

class PromotionApplierService
{
    public function getActivePromotion(Product $product, ?Carbon $now = null): ?Promotion
    {
        $now = $now ?? now();

        $promotion = $product->relationLoaded('promotion')
            ? $product->promotion
            : $product->promotion()->first();

        if (! $promotion) return null;
        if (! $promotion->is_active) return null;

        if ($promotion->starts_at && $now->lt($promotion->starts_at)) return null;
        if ($promotion->ends_at && $now->gt($promotion->ends_at)) return null;

        return $promotion;
    }

    public function hasActivePromotion(Product $product): bool
    {
        return (bool) $this->getActivePromotion($product);
    }

    /** Возвращаем строку "95.00" как и $product->price (decimal cast) */
    public function finalPrice(Product $product): string
    {
        $promotion = $this->getActivePromotion($product);
        $basePrice = (string) $product->price;

        if (! $promotion) return $basePrice;

        if ($promotion->type === 'discount' && $promotion->discount_price !== null) {
            return (string) $promotion->discount_price;
        }

        return $basePrice;
    }

    public function promotionType(Product $product): ?string
    {
        return $this->getActivePromotion($product)?->type;
    }

    public function gift(Product $product): ?array
    {
        $promotion = $this->getActivePromotion($product);

        if (! $promotion) return null;
        if ($promotion->type !== 'gift') return null;
        if (! $promotion->gift_product_id || ! $promotion->gift_quantity) return null;

        return [
            'product_id' => (int) $promotion->gift_product_id,
            'quantity'   => (int) $promotion->gift_quantity,
        ];
    }
}

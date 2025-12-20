<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'sku',
        'price',
        'currency',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'decimal:2',
    ];

    protected $appends = ['main_image_url', 'small_image_url', 'final_price', 'promotion_type', 'gift', 'has_active_promotion'];


    /* ---------- Accessors ---------- */

    // вспомогательно: получаем коллекцию изображений, учитывая eager loading
    protected function getAllImages()
    {
        return $this->relationLoaded('images')
            ? $this->images
            : $this->images()->get();
    }

    protected function resolveMainImage(): ?ProductImage
    {
        $images = $this->getAllImages();
        if ($images->isEmpty()) {
            return null;
        }

        // сначала ищем помеченную как is_main
        $main = $images->firstWhere('is_main', true);
        if ($main) {
            return $main;
        }

        // иначе — с минимальным sort_order
        return $images->sortBy('sort_order')->first();
    }

    public function getMainImageUrlAttribute(): string
    {
        $img = $this->resolveMainImage();

        return $img
            ? asset('storage/' . $img->path)
            : asset('images/default-product-v1.webp');
    }

    public function getSmallImageUrlAttribute(): string
    {
        $images = $this->getAllImages();

        // 1) пробуем найти картинку с small_path
        $small = $images->first(function ($image) {
            return !empty($image->small_path);
        });

        if ($small) {
            return asset('storage/' . $small->small_path);
        }

        // 2) если нет small — используем ту же логику, что и для main
        return $this->main_image_url;
    }

    /* ---------- Relations ---------- */

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(ProductTranslation::class)->where('language', app()->getLocale());
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /* ---------- Scopes / Attributes ---------- */

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')
            ->withPivot('attribute_id')
            ->withTimestamps();
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values', 'product_id', 'attribute_id')
            ->withTimestamps();
    }

    public function promotion()
    {
        return $this->hasOne(\App\Models\Promotion::class);
    }

    public function getHasActivePromotionAttribute(): bool
    {
        return app(\App\Services\PromotionApplierService::class)->hasActivePromotion($this);
    }

    public function getPromotionTypeAttribute(): ?string
    {
        return app(\App\Services\PromotionApplierService::class)->promotionType($this);
    }

    public function getFinalPriceAttribute(): string
    {
        return app(\App\Services\PromotionApplierService::class)->finalPrice($this);
    }

    public function getGiftAttribute(): ?array
    {
        return app(\App\Services\PromotionApplierService::class)->gift($this);
    }
}

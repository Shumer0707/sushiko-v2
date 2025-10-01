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

    protected $appends = ['main_image_url'];

    /* Accessors */
    public function getMainImageUrlAttribute(): ?string
    {
        $img = $this->images()->where('is_main', true)->first() ?? $this->images()->orderBy('sort_order')->first();
        return $img ? asset('storage/' . $img->path) : asset('images/default-product.webp');
    }

    /* Relations */
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

    /* Scopes */
    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')
            ->withPivot('attribute_id') // чтобы знать, к какому атрибуту относится
            ->withTimestamps();
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values', 'product_id', 'attribute_id')
            ->withTimestamps();
    }
}

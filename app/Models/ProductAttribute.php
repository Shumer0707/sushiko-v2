<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    protected $fillable = ['type', 'unit', 'is_filterable', 'is_variant', 'sort_order'];

    // отношения
    public function translations(): HasMany
    {
        return $this->hasMany(AttributeTranslation::class, 'attribute_id');
    }

    public function translation(): HasOne
    {
        return $this->hasOne(AttributeTranslation::class, 'attribute_id')
            ->where('language', app()->getLocale());
    }

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    // опциональный хелпер-аксессор
    public function getTranslatedNameAttribute(): string
    {
        return $this->translation?->name
            ?? $this->translations->firstWhere('language', app()->getLocale())?->name
            ?? '';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values', 'attribute_id', 'product_id')
            ->withTimestamps();
    }
}

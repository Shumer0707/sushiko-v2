<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_id', 'sort_order'];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    // Значение относится к атрибуту
    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

    // Все переводы значения
    public function translations()
    {
        return $this->hasMany(AttributeValueTranslation::class, 'attribute_value_id');
    }

    // Один перевод по текущему языку
    public function translation()
    {
        return $this->hasOne(AttributeValueTranslation::class, 'attribute_value_id')
            ->where('language', app()->getLocale());
    }

    // Товары, у которых установлено это значение (pivot product_attribute_values)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values')
            ->withPivot('attribute_id')
            ->withTimestamps();
    }
}

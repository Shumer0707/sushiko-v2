<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = ['parent_id', 'image'];

    // Автодобавляем в JSON
    protected $appends = ['image_url'];

    // Аксессор для полного URL
    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('storage/placeholders/default.jpg');
            // : asset('images/default-category.png');
    }

    // Родительская категория
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Дочерние категории
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Все переводы
    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // Один перевод (по текущему языку)
    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class)
            ->where('language', app()->getLocale());
    }

    // Удобный доступ к имени
    public function translatedName(): string
    {
        return $this->translation->name ?? '';
    }
}

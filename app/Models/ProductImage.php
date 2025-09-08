<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'is_main',
        'sort_order',
    ];

    protected $casts = [
        'is_main'   => 'boolean',
        'sort_order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /* Удобный URL (если понадобится в списках изображений) */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}

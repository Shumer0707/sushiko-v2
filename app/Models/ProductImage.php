<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'small_path',
        'is_main',
        'sort_order',
    ];

    protected $casts = [
        'is_main'    => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['url', 'small_url', 'size_kb'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    public function getSmallUrlAttribute(): ?string
    {
        return $this->small_path
            ? asset('storage/' . $this->small_path)
            : null;
    }

    public function getSizeKbAttribute(): ?int
    {
        if (!$this->path) return null;

        $disk = Storage::disk('public');
        if (!$disk->exists($this->path)) return null;

        return (int) ceil($disk->size($this->path) / 1024);
    }
}

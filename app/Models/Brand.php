<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    protected $fillable = ['logo', 'is_active', 'sort_order'];
    protected $appends  = ['logo_url'];

    public function getLogoUrlAttribute(): string
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('storage/placeholders/default.jpg');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(BrandTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(BrandTranslation::class)->where('language', app()->getLocale());
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomeBanner extends Model
{
    protected $fillable = [
        'is_active',
        'sort_order',
        'overlay_opacity',
        'link',
        'open_in_new_tab',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'sort_order' => 'integer',
        'overlay_opacity' => 'integer',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(HomeBannerTranslation::class);
    }

    public function translation(): HasOne
    {
        return $this->hasOne(HomeBannerTranslation::class)->where('language', app()->getLocale());
    }
}

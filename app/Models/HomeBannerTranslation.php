<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeBannerTranslation extends Model
{
    protected $fillable = [
        'home_banner_id',
        'language',
        'title',
        'description',
        'button_text',
        'image_desktop',
        'image_mobile',
    ];

    protected $appends = ['image_desktop_url', 'image_mobile_url'];

    public function banner(): BelongsTo
    {
        return $this->belongsTo(HomeBanner::class, 'home_banner_id');
    }

    public function getImageDesktopUrlAttribute(): string
    {
        return asset('storage/' . $this->image_desktop);
    }

    public function getImageMobileUrlAttribute(): string
    {
        return asset('storage/' . $this->image_mobile);
    }
}

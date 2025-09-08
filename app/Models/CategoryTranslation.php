<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends Model
{
    protected $fillable = ['category_id', 'language', 'name', 'slug'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

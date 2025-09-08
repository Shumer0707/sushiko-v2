<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'language',
        'name',
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }
}

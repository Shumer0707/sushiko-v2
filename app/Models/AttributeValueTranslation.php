<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValueTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_value_id', 'language', 'value'];

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
}

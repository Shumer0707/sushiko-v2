<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'delivery_method',
        'address_type',
        'address',
        'house_number',
        'apartment_number',
        'entrance',
        'floor',
        'intercom',
        'payment',
        'total',
        'delivery_cost',
        'total_with_delivery',
        'currency',
        'comment',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

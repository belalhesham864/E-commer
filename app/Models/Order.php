<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'user_name', 'user_phone', 'user_email', 'price', 'price_after_discount','shapping_price', 'total_price', 'note', 'status', 'country', 'governrate', 'city', 'street', 'coupon', 'coupon_discount'];

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = ['user_id','coupon'];
    public function cartItems(){
        return $this->hasMany(cartItem::class);
    }
}

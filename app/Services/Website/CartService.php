<?php

namespace App\services\website;

use App\Models\cart;

class CartService
{
    public function getCart(){
        $userId=auth('web')->user()->id;
        $cart=cart::with('cartItems')
        ->where('user_id',$userId)
        ->get();
        return $cart;
    }
}

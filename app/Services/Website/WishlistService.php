<?php

namespace App\services\website;

use App\Models\Wishlist;

class WishlistService
{
    public function getWishlist(){
        $userId=auth('web')->user()->id;
        $wishLists=Wishlist::with('product')
        ->whereHas('product')

        ->where('user_id',$userId)
        ->latest()
        ->get();
        return $wishLists;
    }

    public function remove($productId){
        $userId=auth('web')->user()->id;
        $wishlist=Wishlist::where('user_id',$userId)->where('product_id',$productId)->first();
        return $wishlist->delete();
    }
    public function removeAll(){
        $userId=auth('web')->user()->id;
       return Wishlist::where('user_id',$userId)->delete();

    }
}

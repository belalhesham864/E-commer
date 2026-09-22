<?php

namespace App\services\website;

use App\Models\Product;

class ProductService
{
    public function showProduct($slug){
        $product=Product::where('slug',$slug)
        ->isActive()
        ->with('images','brand','category')
        ->firstOrFail();
        return $product;
    }

        public function newArriavleProduct($limit = null)
    {
          $newArriavleProduct=Product::query()->with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id');

         if($limit){
          return  $newArriavleProduct->paginate($limit);
         }
         return $newArriavleProduct->paginate(9);
    }
        public function flashProduct($limit = null)
    {
          $flashProduct=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')
        ->where('has_discount',1);
          if($limit){
          return  $flashProduct->paginate($limit);
         }
         return $flashProduct->paginate(9);

    }
        public function flashProductTimer($limit = null)
    {
          $flashProductTimer=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->whereNotNull('available_for')
        ->where('available_for',date('Y-m-d'))
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')
        ->where('has_discount',1);
          if($limit){
          return  $flashProductTimer->paginate($limit);
         }
         return $flashProductTimer->paginate(9);

    }
}

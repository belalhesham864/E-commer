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
          $newArriavleProduct=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')

      ->paginate($limit);
      return $newArriavleProduct;
    }
        public function flashProduct($limit = null)
    {
          $newArriavleProduct=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')
        ->where('has_discount',1)
      ->paginate($limit);
      return $newArriavleProduct;
    }
        public function flashProductTimer($limit = null)
    {
          $flashProductTimer=Product::with('images','brand','category')
        ->isActive()
        ->latest()
        ->whereNotNull('available_for')
        ->where('available_for',date('Y-m-d'))
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id')
        ->where('has_discount',1)
      ->paginate($limit);
      return $flashProductTimer;
    }
}

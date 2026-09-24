<?php

namespace App\services\website;

use App\Models\Product;

class ProductService
{
    public function showProduct($slug){
        $product=Product::with('images','brand','category','productReviews','Variants')
        ->where('slug',$slug)
        ->isActive()
       ->select('id','name','desc','small_desc','sku','slug','price','discount','has_variants','has_discount','brand_id','category_id','manage_stock','quantity')
        ->firstOrFail();
        return $product;
    }

    public function getrelatedProductBySlug($slug,$limit=null){
        $category_id=Product::whereSlug($slug)->first()->category_id;
        $products=Product::query()->with('images','brand','category')
        ->isActive()
        ->whereCategoryId($category_id)
        ->latest()
        ->select('id','name','slug','price','discount','has_variants','has_discount','brand_id','category_id');

         if($limit){
          return  $products->paginate($limit);
         }
         return $products->paginate(30);
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

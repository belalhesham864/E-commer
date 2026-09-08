<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\productVarient;

class ProductRepository
{
      public function getAll(){
      return Product::latest()->get();
      }
      public function getProduct($id){
      return Product::find($id);
      }
      public function getProductwithEgarLoading($id){
      return Product::with(['Variants.VarientAttributes.AttributeValue','category','brand','images'])->find($id);
      }
      public function changeStatus($product){
         $product->status=$product->status ?0:1;
         $product->save();
         return $product;
      }
      public function delete($product){
        return $product->delete();
      }
      public function findVarient($id){
       $varient=productVarient::find($id);
       return $varient;
      }
      public function varientCount($varient){
      $variantsCount = productVarient::where('product_id', $varient->product_id)->count();
       return $variantsCount;
      }
      public function deleteVarient($varient){
     return $varient->delete();
      }

      public function findImage($id){
     return ProductImage::find($id);
      }
      public function deleteProductImage($image){
     return $image->delete();
      }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartItem extends Model
{
  protected $fillable = ['cart_id', 'product_id', 'product_variant_id', 'price', 'quantity', 'attributes'];

  protected $casts = [
    'attributes' => 'array',
  ];

  public function cart(){
    return $this->belongsTo(cart::class);
  }
  public function product(){
    return $this->belongsTo(Product::class,'product_id');
  }
  public function varient(){
    return $this->belongsTo(productVarient::class,'product_variant_id');
  }
  public function getAttributesAttribute($attributes){
    return json_decode($attributes,true);
  }

}

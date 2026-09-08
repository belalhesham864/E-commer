<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarientAttribute extends Model
{
        protected $fillable = ['product_varient_id','attribute_value_id'];

    public function productVarient(){
  return $this->belongsTo(productVarient::class);
    }
    public function AttributeValue(){
  return $this->belongsTo(AttributeValue::class);
    }
}

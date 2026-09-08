<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productVarient extends Model
{
    protected $fillable = ['product_id','price','stock'];
       public function product(){
        return $this->belongsTo(Product::class);
    }
    public function VarientAttributes(){
          return $this->hasMany(VarientAttribute::class);

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
        use HasFactory;
    protected $fillable = ['comment','user_id','product_id'];
           public function Product(){
        return $this->belongsTo(Product::class);
    }
           public function user(){
        return $this->belongsTo(User::class);
    }
}

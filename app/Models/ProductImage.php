<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['file_name','file_size','file_type','product_id'];
           public function Product(){
        return $this->belongsTo(Product::class);
    }
  public function getFileNameAttribute($value){
     return $value ? 'uploads/products/' . $value : null;
  }
}

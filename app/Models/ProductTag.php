<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
        use HasFactory;
    protected $fillable = ['tag_id','product_id'];
           public function Tag(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }
}

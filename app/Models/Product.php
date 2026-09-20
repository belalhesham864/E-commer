<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory,Sluggable;
              public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public $fillable = ['name','small_desc','desc','status','sku','available_for','views','has_variants','price','has_discount'
    ,'discount','start_discount','end_discount','manage_stock','quantity','available_in_stock','category_id','brand_id'];
    public function productVarients(){
        return $this->hasMany(productVarient::class);
    }
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
        public function images(){
        return $this->hasMany(ProductImage::class);
    }
        public function productReviews(){
        return $this->hasMany(ProductReview::class);
    }
        public function Tags(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }
        public function Variants(){
        return $this->hasMany(productVarient::class);
    }
    public function isSimple(){
        return !$this->has_variants;
    }
      public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
    //   public function getAvailableForAttribute($value)
    // {
    //     return date('d/m/Y h:m A', strtotime($value));
    // }
      public function getPriceAttribute($value)
    {
        return $this->has_variants==0 ? number_format($value,2) : 'Yes Variantes';
    }
      public function getQuantityAttribute($value)
    {
        return $this->has_variants==0 ? $value : 'Yes Variantes';
    }
    public function hasVariants(){
        return $this->has_variants==1 ? 'Yes Variantes': 'No Variantes';
    }
    public function status(){
        return $this->status==1 ? 'Active': 'DisActive';
    }

}

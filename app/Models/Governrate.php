<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governrate extends Model
{
        use HasTranslations;
    public array $translatable=['name'];
    public $fillable = ['name','country_id','is_active'];
        

        public $timestamps = false;
   public function country(){
    return $this->belongsTo(Country::class,'country_id');
   }
        public function cities(){
        return $this->hasMany(City::class,'governrate_id');
     }
        public function users(){
        return $this->hasMany(User::class,'governrate_id');
     }
     public function shippingPrice(){
          return $this->hasOne(ShippingGovernrate::class);
     }
}

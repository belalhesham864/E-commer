<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governrate extends Model
{
        use HasTranslations;
    public array $translatable=['name'];
    public $fillable = ['name','country_id'];
        

        public $timestamps = false;
   public function country(){
    return $this->belongsTo(Country::class,'country_id');
   }
        public function cities(){
        return $this->hasMany(City::class,'governrate_id');
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
        use HasTranslations;
    public array $translatable=['name'];
        public $fillable = ['name','governrate_id'];

        public $timestamps = false;
     public function governrate(){
    return $this->belongsTo(Governrate::class,'governrate_id');
   }
}

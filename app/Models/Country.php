<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Translatable\Translatable;

class Country extends Model
{
    use HasTranslations;
    public array $translatable=['name'];
    public $timestamps = false;
        protected $fillable = [
        'name',
        'phone_code',
    ];

     public function governrates(){
        return $this->hasMany(Governrate::class,'country_id');
     }
     public function users(){
        return $this->hasMany(User::class,'country_id');
     }

}

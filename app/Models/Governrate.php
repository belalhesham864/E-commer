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

}

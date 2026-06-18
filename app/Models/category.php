<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class category extends Model
{
        use HasTranslations;

    protected $fillable = ['name'];
        public array $translatable = ['name'];
}

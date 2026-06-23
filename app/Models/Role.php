<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
            use HasTranslations;
  protected $guarded = [];
      public $translatable = ['role'];
protected $casts = [
    // 'role' => 'array',
    // 'permession' => 'array',
];

public function admins(){
    return $this->hasMany(Admin::class);
}
}
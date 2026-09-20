<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class faqQuestion extends Model
{
    protected $fillable = ['name','email','subject','message'];
              public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
}

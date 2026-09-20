<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['id','file_name','product_slug'];
    public function getFileNameAttribute($file_name){
        return 'uploads/sliders/'.$file_name;
    }
    public function getCreatedAtAttribute($value){
      return date('d-m-Y h:i a',strtotime($value));
    }
}

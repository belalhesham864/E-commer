<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table='attributes';
    protected $fillable = ['id','name','created_at','updated_at'];
    public function attributevalues(){
        return $this->hasMany(AttributeValue::class,'attribute_id');
    }
}

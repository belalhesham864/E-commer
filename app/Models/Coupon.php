<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model 
{
    use HasFactory;
    protected $table='coupons';
    protected $fillable = ['code','discount_precentage','start_date','end_date','limit','time_used','is_active'];
        public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
        public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
    public function scopeValid($q){
        return $q->where('is_active',1)
        ->where('time_used','<','limit')
        ->where('end_date','>',now());
    }
    public function scopeInValid($q){
        return $q->where('is_active',0)
        ->where('time_used','>=','limit')
        ->where('end_date','<',now());
    }
    public function couponIsValid(){
        return $this->is_active==1 && $this->time_used < $this->limit && $this->end_date >now();
    }
}


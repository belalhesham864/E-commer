<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingGovernrate extends Model
{
    protected $fillable = ['governrate_id','price'];
    public function governrate()
{
    return $this->belongsTo(Governrate::class);
} 
}

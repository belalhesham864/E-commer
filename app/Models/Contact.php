<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $fillable = ['name','phone','email','is_read','is_start','user_id','subject','message'];
    use HasFactory,SoftDeletes;
    public function user()
{
    return $this->belongsTo(User::class);
}
}

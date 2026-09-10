<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{ 
    protected $table='settings';
    public $timestamps = false;
     protected $fillable = [
        'site_name',
        'site_desc',
        'phone',
        'address',
        'email',
        'email_support',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'meta_desc',
        'logo',
        'favicon',
        'site_copyright',
        'promotion_video_url',
];
public function getLogoAttribute($value){
     return $value ? asset('uploads/settings/' . $value) : null;
}
public function getFaviconAttribute($value){
     return $value ? asset('uploads/settings/' . $value) : null;
}
}

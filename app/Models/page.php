<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    protected $fillable = ['title','slug','content','image','is_active'];
    use Sluggable;
              public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                 'onUpdate' => true,
            ]
        ];
    }
          public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
    public function scopeIsActive($q){
        return $q->where('is_active',1);
    }
          public function getIsActiveAttribute($value)
    {
        return $value==1 ? 'Active':'DisActive';
    }
    public function getImageAttribute($value){
      return  $value!=null ? 'uploads/pages/'.$value :null;
    }
}

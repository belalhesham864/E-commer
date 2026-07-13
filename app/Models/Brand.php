<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use HasTranslations, Sluggable;
    protected $fillable = ['name', 'slug', 'logo', 'status'];
    public array $translatable = ['name'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    public function scopeInActive($q)
    {
        return $q->where('status', 0);
    }
    public function getStatusTranslated()
    {
        if (app()->getLocale() == 'ar') {

            return $this->status == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $this->status == 1 ? 'Active' : 'InActive';
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
    public function getLogoAttribute($value){
        return 'uploads/brands/'.$value;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class category extends Model
{
        use HasTranslations,Sluggable;

    protected $fillable = ['name','slug','status','parent','icon'];
        public array $translatable = ['name'];
        protected $table='categories';
          public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getStatusTranslated(){
 if(app()->getLocale()=='ar'){
        return $this->status==1 ? 'مفعل':'غير مفعل';
       }
       return $this->status==1 ? 'Active':'Inactive';
    }
    public function scopeActive($q){
        return $q->where('status',1);
    }
    public function scopeInActive($q){
        return $q->where('status',0);
    }
    public function getCreatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }
public function getIconAttribute($value)
{
    return $value ? 'uploads/categories/' . $value : null;
}

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
    public function children(){
                return $this->hasMany(category::class,'parent');
    }
    public function parent(){
                return $this->belongsTo(category::class,'parent');
    }

}

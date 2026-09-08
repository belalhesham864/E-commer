<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'is_active',
        'phone',
        'password',
        'governrate_id',
        'country_id',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function country(){
    return $this->belongsTo(Country::class,'country_id');
   }
     public function governrate(){
    return $this->belongsTo(Governrate::class,'governrate_id');
   }
     public function city(){
    return $this->belongsTo(City::class,'city_id');
   }
     public function orders(){
    return $this->hasMany(Order::class);
   }
   public function getStatus(){
    return $this->status==1 ? 'Active' :'InActive';
   }
      public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:m A', strtotime($value));
    }
    public function getEmailVerifiedAtAttribute($value){
        return date('d/m/Y h:m A', strtotime($value));

    }
}

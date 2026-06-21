<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function login($credenstials, $guard, $remberme = false)
    {
        return Auth::guard($guard)->attempt($credenstials, $remberme);
    }
    public function logout( $guard)
    {
        return   Auth::guard($guard)->logout();
    }
    
    public function findAdmin($email){
      return  Admin::where('email', $email)->first();
    }
}

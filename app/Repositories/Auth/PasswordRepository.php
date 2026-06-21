<?php

namespace App\Repositories\Auth;

use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Hash;

class PasswordRepository
{
    /**
     * Create a new class instance.
     */
    public $otp;
    public function __construct(private AuthRepository $authRepository)
    {
        $this->otp=new Otp();
    }
    public function veifayOtp($email,$code)
    {
      return  $this->otp->validate($email,$code);
    }
    public function resetPasword($email,$password)
    {
          $admin=$this->authRepository->findAdmin($email);
      return  $admin->update(['password'=>Hash::make($password)]);
     
    }

}
 
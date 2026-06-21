<?php

namespace App\Services\Auth;

use App\Notifications\Dashboard\Auth\ResetPassword;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\PasswordRepository;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private PasswordRepository $passwordRepository,private AuthRepository $authRepository){}
    public function sendOtp($email){
     $admin=$this->authRepository->findAdmin($email);
     if(!$admin){
        return false;
     }
      $admin->notify(new ResetPassword());
      return $admin;
    }
    public function veifayOtp($email,$code){
      return  $this->passwordRepository->veifayOtp($email,$code);
    }
    public function resetPasword($email,$password){
   return $this->passwordRepository->resetPasword($email,$password);
  
    }

}
 
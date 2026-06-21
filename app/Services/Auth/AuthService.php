<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private AuthRepository $authRepository ){}
  public function login($credenstials,$guard,$remberme){
   
   return $this->authRepository->login($credenstials,$guard,$remberme);
  }
  public function logout($guard){
   
   return $this->authRepository->logout($guard);
  }
  public function findAdmin($email){
  return  $this->authRepository->findAdmin($email);
  }
}

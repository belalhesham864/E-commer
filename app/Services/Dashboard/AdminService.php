<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AdminRepository $adminRepository){}
    public function getAdmins(){
        return $this->adminRepository->getAdmins();
    } 
    public function getAdmin($id){
        $admin= $this->adminRepository->getAdmin($id);
          if(!$admin){
           return false;
        }
        return $admin;
    } 
    public function storeAdmin($request){
        $admin= $this->adminRepository->storeAdmin($request);
        if(!$admin){
            return false;
        }
        return $admin;
    } 
    public function upadteAdmin($request,$id){
        $admin=self::getAdmin($id);
           if(!$admin){
           return false;
        }
        $admin= $this->adminRepository->upadteAdmin($request,$admin);
           if(!$admin){
            return false;
        }
        return $admin;
    } 
    public function deleteAdmin($id){
             $admin=self::getAdmin($id);
                   if(!$admin){
           return false;
        }
        return $this->adminRepository->deleteAdmin($admin);
    }
    public function changeStatus($id){
             $admin=self::getAdmin($id);
           if(!$admin){
           return false;
        }
      $admin->status= 1 ? $status=0 : $status=1;
        return $this->adminRepository->changeStatus($admin,$status);
    }
    public function changePassword($id,$request){
          $admin=self::getAdmin($id);
           if(!$admin){
           return false;
        }
        if(!Hash::check($request['oldPassword'],$admin->password)){
            return false;
        } 
        return $this->adminRepository->changePassword($request,$admin);
    }
} 

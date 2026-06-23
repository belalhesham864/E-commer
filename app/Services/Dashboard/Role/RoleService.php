<?php

namespace App\Services\Dashboard\Role;

use App\Repositories\Dashboard\Role\RoleRepository;

class RoleService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private RoleRepository $roleRepository){ }
     public function create($request){
    return $this->roleRepository->create($request);
    }
     public function allRole(){
    return $this->roleRepository->allRole();
    }
     public function findRole($id){
    $role= $this->roleRepository->findRole($id);
            $role->permession=json_decode($role->permession,true);
return $role;
    }
    public function update($id,$request){
      return  $this->roleRepository->update($id,$request);
    }
    public function destroy($id){
        $role=$this->roleRepository->findRole($id);
        if($role->admins->count()>0 || !$role){
            return false;
        }
      return  $this->roleRepository->destroy($role);
    }
}

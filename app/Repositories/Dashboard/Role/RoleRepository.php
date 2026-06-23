<?php

namespace App\Repositories\Dashboard\Role;

use App\Models\Role;

class RoleRepository
{
    /**
     * Create a new class instance.
     */

    public function allRole(){
        $roles=Role::paginate(5)->through(function ($role) {
            $role->permession=json_decode($role->permession);
            return $role;
        });
        return $roles;
    }
   public function create($request){
    $role=Role::create([
        'role'=>[
            'ar'=>$request->name['ar'],
            'en'=>$request->name['en'],
        ],
        'permession'=>json_encode($request->permission) 
    ]);
    return $role;
   }  
   public function findRole($id){
    $role=Role::findOrFail($id);
    return $role;
   } 


   public function update($id,$request){
    $role=self::findRole($id);
          $update_role=  $role->update([
            'role'=>[
                'en'=>$request->name['en'],
                'ar'=>$request->name['ar'],
            ],
            'permession'=>json_encode($request->permission)
        ]);
        return $update_role;
   }

   public function destroy($role){
       
     return $role->delete();
   }
}

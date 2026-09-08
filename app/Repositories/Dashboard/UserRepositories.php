<?php

namespace App\Repositories\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepositories
{
    public function getAll(){
        $users=User::latest()->get();
        return $users;
    }
    public function findUser($id){
        $user=User::find($id);
        return $user;
    }
    public function storeUser($data){
        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'email_verified_at'=>now(),
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'city_id'=>$data['city_id'],
            'governrate_id'=>$data['governrate_id'],
            'country_id'=>$data['country_id'],
        ]);
        return $user;
    }
    public function changStatus($user){
$user->status=$user->status ? 0 :1;
$user->save();
return $user;
    }
    public function deleteUser($user){
        return $user->delete();
    }
}

<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\UserRepositories;
use Yajra\DataTables\DataTables;

class UserService
{

    public function __construct(private UserRepositories $userRepositories){}
    public function getAll(){
        $users=$this->userRepositories->getAll();
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('status',function($user){
            $status=$user->getStatus();
          return  view("dashboard.users.datatables.status",compact('status')) ;
        })
        ->addColumn('location',function($user){
           return $user->country->name .'-'. $user->governrate->name .'-'. $user->city->name;
        })
     ->editColumn('image',function($user){
          return  view("dashboard.users.datatables.image",compact('user')) ;
     })
        ->editColumn('num_of_order',function($user){
          return $user->orders()->count() >0 ?$user->orders()->count():'Not Found';
        })
        ->addColumn('action',function($user){
            return view('dashboard.users.datatables.action',compact('user'));
        })
        ->make(true);
    }
    public function store($data){
        $user=$this->userRepositories->storeUser($data);
        if(!$user){
            return false;
        }
        return $user;
    }

    public function findUser($id){
        $user=$this->userRepositories->findUser($id);
        if(!$user){
            return false;
        }
        return $user;
    }
        public function delete($id){
        $user = self::findUser($id);

return $this->userRepositories->deleteUser($user);
    }
      public function changeStatus($id)
    {
        $user = self::findUser($id);

        return $this->userRepositories->changStatus($user);
    }
}

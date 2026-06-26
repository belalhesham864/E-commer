<?php

namespace App\Repositories\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminRepository
{
  /**
   * Create a new class instance.
   */
  public function getAdmins()
  {
    return Admin::select('id', 'name', 'email','status', 'created_at', 'role_id')->paginate(1);
  }
  public function getAdmin($id)
  {
    return Admin::findOrFail($id);
  }
  public function storeAdmin($request)
  {
    $admin = new Admin();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->password = $request->password;
    $admin->status = $request->status;
    $admin->role_id = $request->role_id;
    $admin->save();
    return $admin;
  }
  public function upadteAdmin($request, $admin)
  {
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->status = $request->status;
    $admin->role_id = $request->role_id;
    $admin->save();
    return $admin;
  }
  public function deleteAdmin($admin)
  {
    return $admin->delete();
  }
  public function changeStatus($admin, $status)
  {
    $admin->update(['status' => $status]);
    return $admin;
  }
  public function changePassword($request,$admin){
    $admin->update(['password'=>$request['password']]);
     return $admin;
  }
  
}

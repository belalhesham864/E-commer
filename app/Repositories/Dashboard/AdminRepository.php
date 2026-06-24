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
    return Admin::select('id', 'name', 'email', 'created_at', 'role_id')->paginate(6);
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
    $admin->save();
    return $admin;
  }
  public function upadteAdmin($request, $admin)
  {
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->password = $request->password;
    $admin->status = $request->status;
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
}

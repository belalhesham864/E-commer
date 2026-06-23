<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\Role;
use App\Services\Dashboard\Role\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=$this->roleService->allRole();
      
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role=$this->roleService->create($request);
        if(!$role){
            flash()->error('Something with error');
            return redirect()->back();
            }
            flash()->success('Role Created Successfuly');
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $role=$this->roleService->findRole($id);  
        return view('dashboard.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        
      $update_role=  $this->roleService->update($id,$request);

        if(!$update_role){
         flash()->error('Please Try Again Latter');
         return redirect()->back();
        }
        flash()->success('Role Updated Successfuly');
        return redirect()->route('dashboard.roles.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $role =$this->roleService->destroy($id);
      if(!$role){
        flash()->error(__('words.deleteRole'));
                return redirect()->back();

      }
        flash()->success(__('words.deleteRolesuccess'));
        return redirect()->back();
    }
}

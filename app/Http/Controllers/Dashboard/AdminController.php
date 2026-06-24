<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use App\Services\Dashboard\AdminService;
use App\Services\Dashboard\Role\RoleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private AdminService $adminService, private RoleService $roleService) {}
    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->allRole();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $request->validated();
        $admin = $this->adminService->storeAdmin($request);
        if (!$admin) {
            flash()->error('Please Try Again Latter');
            return redirect()->back();
        }
        flash()->success('Admin Created Sucessfuly');
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = $this->adminService->getAdmin($id);
        if (!$admin) {
            flash()->error('Admin Not Found');
            return redirect()->back();
        }
        return view('dashboard.roles.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = $this->roleService->allRole();
        $admin = $this->adminService->getAdmin($id);
        if (!$admin) {
            flash()->error('Admin Not Found');
            return redirect()->back();
        }
        return view('dashboard.admins.Edit', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $request->validated();
        $admin = $this->adminService->upadteAdmin($request,$id);
        if (!$admin) {
            flash()->error('Please Try Again Latter');
            return redirect()->back();
        }
        flash()->success('Admin Updated Sucessfuly');
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
             $admin = $this->adminService->deleteAdmin($id);
        if (!$admin) {
            flash()->error('Please Try Again Latter');
            return redirect()->back();
        }
         flash()->success('Admin Deleted Sucessfuly');
        return redirect()->route('dashboard.admins.index');
    }
    public function changeStatus($id,$request){
        $status=$request->status;
        $this->adminService->changeStatus($id,$status);
    }
}

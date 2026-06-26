<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Http\Requests\Dashboard\ChangePasswordRequest;
use App\Models\Admin;
use App\Services\Dashboard\AdminService;
use App\Services\Dashboard\Role\RoleService;
use Illuminate\Http\Request;

use function Flasher\Prime\flash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private AdminService $adminService, private RoleService $roleService) {}
    public function index()
    {
        $admins = $this->adminService->getAdmins();
         if (request()->ajax()) {
        return view('dashboard.admins.paginate_ajax', compact('admins'));
    }
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
        return view('dashboard.admins.show',compact('admin'));
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
    public function changeStatus($id){
       $status= $this->adminService->changeStatus($id);
       if(!$status){
        flash()->error('Please Try Again Latter');
               return redirect()->back();
       }
       flash()->success('status Updated Successfuly');
       return redirect()->back();
    }
    public function search(Request $request){
        $keyword=$request->search;
        $admins=Admin::where('name','LIKE','%'.$keyword.'%')->orWhere('email','LIKE','%'.$keyword.'%')->paginate(10);
        return view('dashboard.admins.search-ajax',compact('admins'));
    }
    public function changePassword(ChangePasswordRequest $request,$id){
       $updatePassword= $this->adminService->changePassword($id,$request->validated());
       if(!$updatePassword){
  return back()->withErrors([
        'oldPassword' => 'Current password is incorrect.'
    ]);   
       }
       flash()->success('Password Updated Successfuly');
       return redirect()->route('dashboard.admins.index');
    }
}

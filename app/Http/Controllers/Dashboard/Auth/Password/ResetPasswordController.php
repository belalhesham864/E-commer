<?php

namespace App\Http\Controllers\Dashboard\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ResetPasswordRequest;
use App\Models\Admin;
use App\Services\Auth\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
     public function __construct(private PasswordService $passwordService){}

    public function showForm(Request $request){
        $email=$request->email;
        return view('dashboard.auth.password.reset',compact('email'));
        

    }
    public function resetPassword(ResetPasswordRequest $request){
        
      $data=$request->validated();
        $admin=$this->passwordService->resetPasword($data['email'],$data['password']);
        if(!$admin){
            flash()->error(__('auth.please try again latter'));
            return redirect()->back();
        }   
        flash()->success(__('auth.Password Updated Successfuly'));
     
        return redirect()->route('dashboard.login');
        
        
    }
}

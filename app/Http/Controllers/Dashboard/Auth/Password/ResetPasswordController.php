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
        if(!session('otp_verified')){
            return redirect()->route('dashboard.password.showform');
        }
        return view('dashboard.auth.password.reset');
        

    }
    public function resetPassword(ResetPasswordRequest $request){
        
      $data=$request->validated();
       if(!session('otp_verified')){
            return redirect()->route('dashboard.password.showform');
        }
        $email=session('reset_email');
        $admin=$this->passwordService->resetPasword($email,$data['password']);
        if(!$admin){
            flash()->error(__('auth.please try again latter'));
            return redirect()->back();
        }   
        session()->forget(['reset_email','otp_verified']);
        flash()->success(__('auth.Password Updated Successfuly'));
     
        return redirect()->route('dashboard.login');
        
        
    }
}

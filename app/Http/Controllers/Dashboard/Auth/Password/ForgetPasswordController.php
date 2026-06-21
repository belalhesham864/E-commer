<?php

namespace App\Http\Controllers\Dashboard\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\ForgetPasswordRequest;
use App\Models\Admin;
use App\Notifications\Dashboard\Auth\ResetPassword;
use App\Services\Auth\AuthService;
use App\Services\Auth\PasswordService;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected $otp;
    public function __construct(private AuthService $authService, private PasswordService $passwordService)
    {
        $this->otp = new Otp();
    }
    public function email()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendOtp(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        $this->passwordService->sendOtp($data['email']);
        flash()->success('Otp Send , Check your Email');
        return redirect()->route('dashboard.password.confirm', ['email' => $data['email']]);
    }

    public function sendOtpAgain($email)
    {
        $this->passwordService->sendOtp($email);
        flash()->success('Otp Send Successfuly');
        return redirect()->back();
    }


    public function confirm(Request $request)
    {
        return view('dashboard.auth.password.confirm', [
            'email' => $request->email
        ]);
    }

    public function verifyOtp(ForgetPasswordRequest $request)
    {
        $data = $request->validated();

        $check =  $this->passwordService->veifayOtp($data['email'],$data['code']);
        if ($check->status == false) {
            flash()->error(__('passwords.token'));
            return redirect()->back()->withErrors(['error' => __('passwords.token')]);
        }

        flash()->success(__('auth.success otp'));
        return redirect()->to(route('dashboard.password.showform', [
            'email' => $data['email']
        ]));
    }
}

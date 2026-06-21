<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Models\Admin;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller implements HasMiddleware
{
    public function __construct(private AuthService $authservics) {}
    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout'])
        ];
    }
    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }
    public function login(LoginRequest $request)
    {
        $request->validated();

        $credenstials = $request->only(['email', 'password']);

        if ($this->authservics->login($credenstials, 'admin', $request->remberme)) {
            $admin =$this->authservics->findAdmin($request->email);
            flash()->success('Welcome Back Mr .' . $admin->name);
            return redirect()->intended(route('dashboard.welcome'));
        } else {
            return redirect()->back()->withErrors(['email' => __('auth.failed')]);
        }
    }
    public function logout(Request $request)
    {
       $this->authservics->logout('admin');
        flash()->success('Logout Success');
        return redirect()->route('dashboard.login');
    }
}

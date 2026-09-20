<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function redirectTo()
    {
        return route('Home.index');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('website.auth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        return route('Home.index');
    }

    public function showLoginForm()
    {
        return view('website.auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
          'email' => 'required|exists:users,email',
            'password' => 'required|string',
            'rememberMe' => 'in:on,off',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->status==1){
            flash()->success('Welcome back, ' . $user->name . '!');
        }
        return redirect()->route('Home.index');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('login');
    }
  protected function loggedOut(Request $request)
    {
    flash()->success('You have been logged out successfully. See you again soon!');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

}

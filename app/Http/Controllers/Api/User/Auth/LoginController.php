<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
       $data= $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user || Hash::check($data['password'], $user->password) == false) {
            return response()->json(['message' => 'invailed User'], 401);
        }
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json(['message' => 'login success', 'user' => $user,'token'=>$token], 200);
    }
}

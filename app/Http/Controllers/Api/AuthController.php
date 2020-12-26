<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false, 'error' => 'Login failed'], 401);
        }
        return response()->json([
            'success' => true,
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['success' => true], 200);
    }
    public function checkToken()
    {
        return response()->json(['success' => true],200);
    }

}

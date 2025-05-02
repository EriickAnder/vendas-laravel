<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = JWTAuth::attempt($credentials)) {

            return response()->json([
                'message' => 'success',
                'token' => 'Bearer ' . $token
            ], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

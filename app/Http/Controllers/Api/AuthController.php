<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Login API
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'token'   => $user->createToken('API Token')->plainTextToken,
            'user'    => $user,
        ]);
    }
}

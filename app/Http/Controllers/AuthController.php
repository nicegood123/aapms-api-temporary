<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{

    // Login
    public function login(Request $request)
    {

        $input = $request->all();

        $validate = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response([
                'message' => $validate->errors()->first(),
            ], 400);
        }

        // Check Email
        $user = User::where('email', $input['email'])->first();

        // Check Password
        if (!$user || !Hash::check($input['password'], $user->password)) {
            return response([
                'message' => "Your password is incorrect or this account doesn't exist. Please try again."
            ], 401);
        }

        if ($user->active == 0) {
            return response([
                'message' => "Your account has not been activated yet."
            ], 401);
        }

        $token = $user->createToken('AAPMS')->plainTextToken;

        return response([
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 200);
    }

    // Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => "User logout."
        ], 200);
    }
}

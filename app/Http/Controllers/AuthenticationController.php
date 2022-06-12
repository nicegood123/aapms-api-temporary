<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthenticationController extends Controller
{

    /**
     * User Login
     * 
     * @param Request $request
     * @return Response
     */
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

        if($user->status == 'Inactive') {
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


    /**
     * User Logout
     * 
     * @return Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => "User logout."
        ], 200);
    }
}

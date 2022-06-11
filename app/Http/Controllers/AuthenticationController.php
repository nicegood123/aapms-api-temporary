<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthenticationController extends Controller
{


    /**
     * Create Account
     * 
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'position' => 'required',
            'password' => 'required',
            'access_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $input['password'] = bcrypt($input['password']);
        $input['role'] = ($request->type == 'Program') ? 'Regular' : 'Admin';
        $input['access_id'] = $request->access_id;
        $user = User::create($input);

        return response([
            'message' => 'Registration completed successfully.',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }



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
                'status' => $user->status,
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

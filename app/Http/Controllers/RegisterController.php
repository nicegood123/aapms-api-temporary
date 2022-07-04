<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{

    // Account Registration
    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return response([
            'message' => 'Registration completed successfully.',
            'data' => [
                'user' => $user,
            ]
        ], 200);
    }



}

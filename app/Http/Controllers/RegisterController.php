<?php

namespace App\Http\Controllers;

use App\Models\CollegeUser;
use App\Models\ProgramUser;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{

    // Account Registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'position' => 'required',
            'type' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $request['user_types'] = ($request->type == 'College') ? 2 : 1;
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());

        if ($request->type == 'College') {
            CollegeUser::addCollegeUser($request->type_id, $user->id);
        } else {
            ProgramUser::addProgramuser($request->type_id, $user->id);
        }

        return response([
            'message' => 'Registration completed successfully.',
            'data' => [
                'user' => $user,
            ]
        ], 200);
    }
}

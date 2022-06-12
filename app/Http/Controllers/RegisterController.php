<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
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
            'password' => 'required',
            'position' => 'required',
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
     * Get Types (Institutional, College, Program)
     * 
     * @param Request $request
     * @return Response
     */
    public function getType(Request $request)
    {
      
    $types = Type::getTypes($request);

        return response([
            'message' => 'Types Retrieved.',
            'data' => [
                'types' => $types
            ]
   
        ], 200);
    }
}

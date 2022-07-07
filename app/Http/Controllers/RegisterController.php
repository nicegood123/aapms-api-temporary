<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\CollegeUser;
use App\Models\Program;
use App\Models\ProgramUser;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{

    // Account Registrations
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


    // Get List of Types(Institutionals/Colleges/Programs)
    public static function getTypes(Request $request)
    {
        $query = Program::whereRaw(
            '(name LIKE ? OR description LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        if ($request->type == 'Institutional') {
            $query->where('is_institutional', 1);
        } elseif ($request->type == 'Program') {
            $query->where('is_institutional', 0);
        } elseif ($request->type == 'College') {
            $query = College::whereRaw(
                '(name LIKE ? OR description LIKE ?)',
                [
                    '%' . $request->search . '%',
                    '%' . $request->search . '%'
                ]
            );
        }

        $types = $query->paginate(5);

        return response([
            'message' => 'Types retreived.',
            'data' => [
                'types' => $types,
            ]
        ], 200);
    }
}

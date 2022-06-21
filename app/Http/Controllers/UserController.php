<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    /**
     * Get Users
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = User::whereRaw(
            '(firstname LIKE ? OR lastname LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        if ($request->access_id != "") {
            $query->where('access_id', $request->access_id);
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        

        $users = $query->latest()->paginate(20);

        if (!$users) {
            return response([
                'message' => 'Users not found.',
            ], 404);
        }

        return response([
            'message' => 'Users have been retrieved.',
            'data' => [
                'users' => $users
            ]
        ], 200);
    }


    /**
     * Add User
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric',
            'position' => 'required',
            'role' => 'required',
        ]);


        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $input['password'] = bcrypt($input['email_address']);
        $user = User::create($input);

        return response([
            'message' => 'User created.',
            'data' => [
                'users' => $user
            ]
        ], 200);
    }


    /**
     * Get User
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response([
            'message' => 'User retreived.',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }


    /**
     * Update User
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric',
            'position' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $user = User::find($id);
        $user->firstname = $input['firstname'];
        $user->lastname = $input['lastname'];
        $user->username = $input['username'];
        $user->mobile_number = $input['mobile_number'];
        $user->email = $input['email'];
        $user->role = $input['role'];
        $user->position = $input['position'];
        $user->save();

        return response([
            'message' => 'User updated.',
            'data' => [
                'user' => $user
            ]
        ], 200);
    }

    /**
     * Delete User
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();

        return response([
            'message' => 'User deleted.',
        ], 200);
    }

    /**
     * Change Password the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => [
                'required', Password::min(8)
                    ->letters()->mixedCase()->numbers()
            ],
            'confirm_password' => 'same:new_password',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $user = User::find(auth()->user()->id);

        if (!Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Incorrect Password'
            ], 403);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response([
            'message' => 'Password changed!'
        ], 200);
    }

    /**
     * Update User Status
     *
     * @param Requst $request
     * @param int $id
     * @return Response
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->status = $request->status;
        $user->save();

        return response([
            'message' => 'Status updated.'
        ], 200);
    }

    /**
     * Unassign User
     *
     * @param int $id
     * @return Response
     */
    public function unAssignUser($id)
    {
        $user = User::find($id);
        $user->access_id = 0;
        $user->save();

        return response([
            'message' => 'User removed.'
        ], 200);
    }

    /**
     * Assign User
     *
     * @param int $id, Request $request
     * @return Response
     */
    public function assignUser($id, Request $request)
    {
        $user = User::find($id);
        $user->access_id = $request->access_id;
        $user->save();

        return response([
            'message' => 'User assigned.'
        ], 200);
    }
}

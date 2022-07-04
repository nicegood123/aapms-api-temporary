<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'user_id',
    ];

    public static function getDepartments(Request $request)
    {
        $query = Department::whereRaw(
            '(name LIKE ? OR description LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        if ($request->department == 'Institutional') {
            $query->where('is_institutional', 1);
        }

        $departments = $query->paginate(5);

        return $departments;
    }

    // Add New Program User
    public function addProgramUser(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'type' => 'required',
        ]);

        if ($request->type == "") {
            return response([
                'message' => "Type is required.",
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

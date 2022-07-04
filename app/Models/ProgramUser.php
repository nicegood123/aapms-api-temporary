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

    // Add New Program User
    public function addProgramUser(Request $request)
    {

        // if ($request->type == "") {
        //     return response([
        //         'message' => "Type is required.",
        //     ], 400);
        // }

        $programUser = ProgramUser::create($request);

        return response([
            'message' => 'Program User Added.',
            'data' => [
                'program_user' => $programUser,
            ]
        ], 200);
    }
}

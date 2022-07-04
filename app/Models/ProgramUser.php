<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUser extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'program_id',
        'user_id',
    ];

    // Add New Program User
    public function addProgramUser($program_id, $user_id)
    {
        $programUser = ProgramUser::create([
            'program_id' => $program_id,
            'user_id' => $user_id
        ]);

        return response([
            'message' => 'Program User Added.',
            'data' => [
                'program_user' => $programUser,
            ]
        ], 200);
    }
}

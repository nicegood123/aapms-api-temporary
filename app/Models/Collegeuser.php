<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeUser extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'college_id',
        'user_id',
    ];

    // Add New College User
    public function addCollegeUser($college_id, $user_id)
    {
        $collegeUser = CollegeUser::create([
            'college_id' => $college_id,
            'user_id' => $user_id
        ]);

        return response([
            'message' => 'College User Added.',
            'data' => [
                'college_user' => $collegeUser,
            ]
        ], 200);
    }
}

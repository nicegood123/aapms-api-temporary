<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'phone_number',
        'email_address',
        'role',
        'position',
        'access_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get List of College Users
     * 
     * @param Request $request, $collegeId
     * @return Response
     */
    public static function getCollegeUsers(Request $request, $collegeId)
    {

        $query = User::whereRaw(
            '(firstname LIKE ? OR lastname LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        $users = $query->where('role', '=', 'Admin')
            ->where('access_id', '=', $collegeId)
            ->latest()->paginate(20);

        return $users;
    }

    /**
     * Get List of Program Users
     * 
     * @param Request $request, $programId
     * @return Response
     */
    public static function getProgramUsers(Request $request, $programId)
    {

        $query = User::whereRaw(
            '(firstname LIKE ? OR lastname LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        $users = $query->where('role', '=', 'Regular')
            ->where('access_id', '=', $programId)
            ->latest()->paginate(20);

        return $users;
    }
}

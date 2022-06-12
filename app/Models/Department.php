<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'isInstitutional'
    ];


    /**
     * Get List of Departments
     * 
     * @return Response
     */
    public static function getDepartments(Request $request)
    {
        $query = Department::latest();
        if ($request->department == 'Institutional') {
            $query->where('isInstitutional', 1);
        } elseif ($request->department == 'College') {
            $query->where('isInstitutional', 0);
        } elseif ($request->department == 'Program') {
            $query = Program::latest();
        }

        $departments = $query->paginate(10);

        return $departments;
    }
}

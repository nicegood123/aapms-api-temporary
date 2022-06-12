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
        'is_institutional'
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
            $query->where('is_institutional', 1);
        } elseif ($request->department == 'College') {
            $query->where('is_institutional', 0);
        } elseif ($request->department == 'Program') {
            $query = Program::latest();
        }

        $departments = $query->paginate(5);

        return $departments;
    }
}

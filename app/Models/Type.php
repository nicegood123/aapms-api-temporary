<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;


class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'isInstitutional'
    ];


    /**
     * Get List of Types
     * 
     * @return Response
     */
    public static function getTypes(Request $request)
    {
        $query = Type::latest();
        if ($request->type == 'Institutional') {
            $query->where('isInstitutional', 1);
        } elseif ($request->type == 'College') {
            $query->where('isInstitutional', 0);
        } elseif ($request->type == 'Program') {
            $query = Program::latest();
        }

        $types = $query->paginate(10);

        return $types;
    }
}

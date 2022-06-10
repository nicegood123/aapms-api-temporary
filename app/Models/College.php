<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description'
    ];

        /**
     * Get List of Program Users
     * 
     * @param Request $request, $programId
     * @return Response
     */
    public static function getProgramCollege($programId)
    {

        return College::find($programId);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;
use Illuminate\Http\Request;


class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'name',
        'description'
    ];


    /**
     * Get College Progrsm
     * 
     * @param $programId, Request $request
     * @return Response
     */
    public static function getProgramsByCollegeId($collegeId, Request $request)
    {

        $programsQuery = Program::where('college_id', $collegeId);
        
        $programs = $programsQuery->whereRaw(
            '(name LIKE ? OR description LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        )->latest()->paginate(20);

        foreach ($programs as $program) {
            $program->count = Report::getTotalActionPlansByStatus($request, $program->id, "Program");
        }

        return $programs;
    }
}

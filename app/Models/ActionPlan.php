<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\College;
use App\Models\Program;
use App\Models\FeedbackSource;
use Illuminate\Http\Request;

class ActionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feedback_source_id',
        'feedback',
        'actions_to_be_taken',
        'expected_compliance_period',
        'status',
        'expected_outcome',
        'means_of_verification',
        'person_in_charge_id',
        'action_to',
        'action_to_id',
        'created_at'
    ];


    /**
     * Get College Action Plans
     * 
     * @param $collegeId, Request $request
     * @return Response
     */
    public static function getActionPlansByCollegeId($collegeId, Request $request)
    {
        $query = ActionPlan::select('action_plans.*')
            ->join('feedback_sources', 'action_plans.feedback_source_id', 'feedback_sources.id')
            ->where('action_to', 'College')
            ->where('action_to_id', $collegeId);

        if ($request->date) {
            $query->where('action_plans.created_at', 'LIKE', '%' . $request->date . '%');
        }

        if ($request->status) {
            $query->where('action_plans.status', 'LIKE', '%' . $request->status . '%');
        }

        $query->where('feedback_sources.name', 'LIKE', '%' . $request->search . '%');

        $actionPlans = $query->orderBy('action_plans.created_at', 'DESC')
            ->paginate(20);

        return $actionPlans;
    }

    /**
     * Get Program Action Plans
     * 
     * @param $programId, Request $request
     * @return Response
     */
    public static function getActionPlansByProgramId($programId, Request $request)
    {
        $query = ActionPlan::select('action_plans.*')
            ->join('feedback_sources', 'action_plans.feedback_source_id', 'feedback_sources.id')
            ->where('action_to', 'Program')
            ->where('action_to_id', $programId);

        if ($request->date) {
            $query->where('action_plans.created_at', 'LIKE', '%' . $request->date . '%');
        }

        if ($request->status) {
            $query->where('action_plans.status', 'LIKE', '%' . $request->status . '%');
        }

        $query->where('feedback_sources.name', 'LIKE', '%' . $request->search . '%');

        if ($request->college_id) {
            $query->where('action_plans.college_id', '=', $request->college_id);
        }

        $actionPlans = $query->orderBy('action_plans.created_at', 'DESC')
            ->paginate(20);

        return $actionPlans;
    }


    /**
     * Get List of Delayed Action Plans
     * 
     * @param Request $request
     * @return Response
     */
    public static function getDelayedActionPlans(Request $request)
    {

        $query = ActionPlan::select('action_plans.*')
            ->join('feedback_sources', 'action_plans.feedback_source_id', 'feedback_sources.id')
            ->where('status', 'Delayed');

        if ($request->date) {
            $query->where('action_plans.created_at', 'LIKE', '%' . $request->date . '%');
        }

        if ($request->status) {
            $query->where('action_plans.status', 'LIKE', '%' . $request->status . '%');
        }

        $query->where('feedback_sources.name', 'LIKE', '%' . $request->search . '%');

        $delayed = $query->orderBy('action_plans.created_at', 'DESC')
            ->paginate(5);

        return $delayed;
    }


    /**
     * Get List of Latest Action Plans
     * 
     * @param Request $request
     * @return Response
     */
    public static function getLatestActionPlans(Request $request)
    {

        $query = ActionPlan::select('action_plans.*')
            ->join('feedback_sources', 'action_plans.feedback_source_id', 'feedback_sources.id');

        if ($request->date) {
            $query->where('action_plans.created_at', 'LIKE', '%' . $request->date . '%');
        }

        if ($request->status) {
            $query->where('action_plans.status', 'LIKE', '%' . $request->status . '%');
        }

        $query->where('feedback_sources.name', 'LIKE', '%' . $request->search . '%');

        $latest = $query->orderBy('action_plans.created_at', 'DESC')
            ->paginate(5);

        return $latest;
    }
    

    /**
     * Map data
     * 
     * @param $actionPlan
     * @return Response
     */
    public static function mapData($actionPlan)
    {
        $actionPlan->feedback_source = FeedbackSource::find($actionPlan->feedback_source_id);
        $actionPlan->created_by = User::find($actionPlan->user_id);
        $actionPlan->person_in_charge = User::find($actionPlan->person_in_charge_id);

        if ($actionPlan->action_to == 'College') {
            $actionPlan->college = College::find($actionPlan->action_to_id);
        } else {
            $actionPlan->program = Program::find($actionPlan->action_to_id);
        }

        return $actionPlan;
    }


    /**
     * Get Action Plans Total By Status From College
     * 
     * @param $collegeId
     * @return Response
     */
    public static function getTotalCollegeActionPlansByStatus($collegeId)
    {
        $compliedQuery = ActionPlan::where('status', 'Complied');
        $ongoingQuery = ActionPlan::where('status', 'On-going');
        $delayedQuery = ActionPlan::where('status', 'Delayed');

        $complied = $compliedQuery->where('action_to', '=', 'College')
            ->where('action_to_id', '=', $collegeId)->count();

        $ongoing = $ongoingQuery->where('action_to', '=', 'College')
            ->where('action_to_id', '=', $collegeId)->count();

        $delayed = $delayedQuery->where('action_to', '=', 'College')
            ->where('action_to_id', '=', $collegeId)->count();

        return [
            'complied' => $complied,
            'ongoing' => $ongoing,
            'delayed' => $delayed,
        ];
    }

    /**
     * Get Action Plans Total By Status From Program
     * 
     * @param $programId
     * @return Response
     */
    public static function getTotalProgramActionPlansByStatus($programId)
    {
        $compliedQuery = ActionPlan::where('status', 'Complied');
        $ongoingQuery = ActionPlan::where('status', 'On-going');
        $delayedQuery = ActionPlan::where('status', 'Delayed');

        $complied = $compliedQuery->where('action_to', 'Program')
            ->where('action_to_id', $programId)->count();

        $ongoing = $ongoingQuery->where('action_to', 'Program')
            ->where('action_to_id', $programId)->count();

        $delayed = $delayedQuery->where('action_to', 'Program')
            ->where('action_to_id', $programId)->count();

        return [
            'complied' => $complied,
            'ongoing' => $ongoing,
            'delayed' => $delayed,
        ];
    }
}

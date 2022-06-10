<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;

class Report extends Model
{
    use HasFactory;


    /**
     * Get Total Reports
     * 
     * @return Response
     */
    public static function getTotalReports()
    {
        $users = User::count();
        $colleges = College::count();
        $programs = Program::count();
        $actionPlans = ActionPlan::count();
        $feedbackSources = FeedbackSource::count();

        return [
            'users' => $users,
            'colleges' => $colleges,
            'programs' => $programs,
            'action_plans' => $actionPlans,
            'feedback_sources' => $feedbackSources
        ];
    }

    /**
     * Get Total Action Plans By Status
     * 
     * @param Request $request
     * @return Response
     */
    public static function getTotalActionPlansByStatus(Request $request, $actionId = "", $actionTo = "")
    {
        $compliedQuery = ActionPlan::where('status', 'Complied');
        $ongoingQuery = ActionPlan::where('status', 'On-going');
        $delayedQuery = ActionPlan::where('status', 'Delayed');
        $pendingQuery = ActionPlan::where('status', 'Pending');

        if ($actionId && $actionTo) {
            $compliedQuery->where('action_to_id', $actionId)
                ->where('action_to', $actionTo);

            $ongoingQuery->where('action_to_id', $actionId)
                ->where('action_to', $actionTo);

            $delayedQuery->where('action_to_id', $actionId)
                ->where('action_to', $actionTo);

            $pendingQuery->where('action_to_id', $actionId)
                ->where('action_to', $actionTo);
        }

        if ($request->year) {
            $compliedQuery->whereYear('created_at', $request->year);
            $ongoingQuery->whereYear('created_at', $request->year);
            $delayedQuery->whereYear('created_at', $request->year);
            $pendingQuery->whereYear('created_at', $request->year);
        }

        if ($request->month) {
            $compliedQuery->whereMonth('created_at', $request->month);
            $ongoingQuery->whereMonth('created_at', $request->month);
            $delayedQuery->whereMonth('created_at', $request->month);
            $pendingQuery->whereMonth('created_at', $request->month);
        }

        $complied = $compliedQuery->count();
        $ongoing = $ongoingQuery->count();
        $delayed = $delayedQuery->count();
        $pending = $pendingQuery->count();

        return [
            'complied' => $complied,
            'ongoing' => $ongoing,
            'delayed' => $delayed,
            'pending' => $pending,
        ];
    }

    public static function getAnnualReport(Request $request)
    {
        $complied = ActionPlan::selectRaw('DATE_FORMAT(created_at, "%m") as month, COUNT(id) as complied')
            ->whereYear('created_at', $request->year)
            ->where('status', 'Complied')
            ->groupByRaw('month')
            ->get();

        foreach ($complied as $actionPlan) {
            $actionPlan->total = ActionPlan::whereMonth('created_at', $actionPlan->month)
                ->whereYear('created_at', $request->year)->count();
        }

        return $complied;
    }
}

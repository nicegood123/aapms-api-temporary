<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\Report;
use Illuminate\Http\Request;
use Validator;


class DashboardController extends Controller
{

    /**
     * Get Total Reports
     * 
     * @return Response
     */
    public function count()
    {
        $totalReports = Report::getTotalReports();

        return response([
            'message' => 'Total reports',
            'data' => ['count' => $totalReports]
        ], 200);
    }


    /**
     * Get Total Action Plans By Status
     * 
     * @param Request $request
     * @return Response
     */
    public function actionPlans(Request $request)
    {
        $actionPlans = Report::getTotalActionPlansByStatus($request);

        return response([
            'message' => 'Total action plans per status.',
            'data' => ['action_plans' => $actionPlans]
        ], 200);
    }

        /**
     * Get annual action plans report
     * 
     * @param Request $request
     * @return Response
     */
    public function annualActionPlansReport(Request $request)
    {
        $actionPlans = Report::getAnnualReport($request);

        return response([
            'message' => 'Total annual action plans report.',
            'data' => ['action_plans' => $actionPlans]
        ], 200);
    }

    /**
     * Get List of Delayed Action Plans
     * 
     * @param Request $request
     * @return Response
     */
    public function delayedActionPlans(Request $request)
    {
        $actionPlans = ActionPlan::getDelayedActionPlans($request);

        foreach ($actionPlans as $actionPlan) {
            $actionPlan = ActionPlan::mapData($actionPlan);
        }


        return response([
            'message' => 'Delayed action plans.',
            'data' => [
                'action_plans' => $actionPlans
            ]
        ], 200);
    }

        /**
     * Get List of Latest Action Plans
     * 
     * @param Request $request
     * @return Response
     */
    public function latestActionPlans(Request $request)
    {
        $actionPlans = ActionPlan::getLatestActionPlans($request);

        foreach ($actionPlans as $actionPlan) {
            $actionPlan = ActionPlan::mapData($actionPlan);
        }


        return response([
            'message' => 'Latest action plans.',
            'data' => [
                'action_plans' => $actionPlans
            ]
        ], 200);
    }
}

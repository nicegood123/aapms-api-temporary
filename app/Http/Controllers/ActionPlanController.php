<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use Illuminate\Http\Request;
use Validator;

class ActionPlanController extends Controller
{

    /**
     * Get Action Plans
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
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

        if ($request->college_id) {
            $query->where('action_plans.college_id', $request->college_id);
        }

        if ($request->action_to == 'College') {
            if ($request->college_id) {
                $query->where('action_plans.action_to_id', $request->college_id)
                    ->where('action_plans.action_to', 'College');
            } else {
                $query->where('action_plans.action_to', 'College');
            }
        } else if ($request->action_to == 'Program') {
            if ($request->program_id) {
                $query->where('action_plans.action_to_id', $request->college_id)
                    ->where('action_plans.action_to', 'Program');
            } else {
                $query->where('action_plans.action_to', 'Program');
            }
        }

        $actionPlans = $query->orderBy('action_plans.created_at', 'DESC')
            ->paginate(20);



        foreach ($actionPlans as $actionPlan) {
            $actionPlan = ActionPlan::mapData($actionPlan);
        }

        return response([
            'message' => 'Action plans retreived.',
            'data' => [
                'action_plans' => $actionPlans
            ]
        ], 200);
    }

    /**
     * Get Action Plan Details
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $actionPlan = ActionPlan::mapData(ActionPlan::find($id));

        return response([
            'message' => 'Action plan retreived.',
            'data' => [
                'action_plan' => $actionPlan
            ]
        ], 200);
    }

    /**
     * Store Action Plan
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'created_at' => 'required',
            'feedback_source_id' => 'required',
            'feedback' => 'required',
            'actions_to_be_taken' => 'required',
            'expected_compliance_period' => 'required',
            'status' => 'required',
            'expected_outcome' => 'required',
            'means_of_verification' => 'required',
            'person_in_charge_id' => 'required',
            'action_to' => 'required',
            'action_to_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $input['user_id'] = auth()->user()->id;
        return response([
            'message' => 'Action plan added.',
            'data' => [
                'action_plan' => ActionPlan::create($input)
            ]
        ], 200);
    }


    /**
     * Update Action Plan
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'created_at' => 'required',
            'feedback_source_id' => 'required',
            'feedback' => 'required',
            'actions_to_be_taken' => 'required',
            'expected_compliance_period' => 'required',
            'status' => 'required',
            'expected_outcome' => 'required',
            'means_of_verification' => 'required',
            'person_in_charge_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $actionPlan = ActionPlan::find($id);
        $actionPlan->created_at = $input['created_at'];
        $actionPlan->feedback_source_id = $input['feedback_source_id'];
        $actionPlan->feedback = $input['feedback'];
        $actionPlan->actions_to_be_taken = $input['actions_to_be_taken'];
        $actionPlan->expected_compliance_period = $input['expected_compliance_period'];
        $actionPlan->status = $input['status'];
        $actionPlan->expected_outcome = $input['expected_outcome'];
        $actionPlan->means_of_verification = $input['means_of_verification'];
        $actionPlan->person_in_charge_id = $input['person_in_charge_id'];
        $actionPlan->save();

        return response([
            'message' => 'Action plan updated.',
            'data' => [
                'action_plan' => $actionPlan
            ]
        ], 200);
    }

    /**
     * Delete Action Plan
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function delete($id)
    {
        $actionPlan = ActionPlan::find($id);
        $actionPlan->delete();

        return response([
            'message' => 'Action plan Deleted.',
        ], 200);
    }
}

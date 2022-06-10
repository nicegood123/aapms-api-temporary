<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\College;
use App\Models\Program;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ProgramController extends Controller
{

    /**
     * Get Programs
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Program::whereRaw(
            '(name LIKE ? OR description LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        if ($request->college_id > 0) {
            $query->where('college_id', $request->college_id);
        }

        $programs = $query->latest()->paginate(20);

        foreach ($programs as $program) {
            $program->count = Report::getTotalActionPlansByStatus($request, $program->id, "Program");
            $program->college = College::getProgramCollege($program->college_id);
        }

        return response([
            'message' => 'Programs retreived.',
            'data' => [
                'programs' => $programs,
            ]
        ], 200);
    }

    /**
     * Get Program Action Plans
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function getActionPlans(Request $request, $id)
    {
        $actionPlans = ActionPlan::getActionPlansByProgramId($id, $request);

        if (!$actionPlans) {
            return response([
                'message' => 'Program action plans not found.',
            ], 404);
        }

        foreach ($actionPlans as $actionPlan) {
            $actionPlan = ActionPlan::mapData($actionPlan);
        }

        return response([
            'message' => 'Program action plans retreived.',
            'data' => [
                'action_plans' => $actionPlans,
            ]
        ], 200);
    }

    /**
     * Get Program Details
     * 
     * @param $id
     * @return Response
     */
    public function show($id, Request $request)
    {
        $program = Program::find($id);

        $program->count = Report::getTotalActionPlansByStatus($request, $program->id, "Program");
        $program->college = College::getProgramCollege($program->college_id);
        $program->users = User::getProgramUsers($request, $program->id);

        return response([
            'message' => 'Program retreived.',
            'data' => [
                'program' => $program,
            ]
        ], 200);
    }

    /**
     * Add Program
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'college_id' => 'required',
            'name' => 'required|unique:programs,name',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'Program added.',
            'data' => [
                'program' => Program::create($input)
            ]
        ], 200);
    }

    /**
     * Update Program
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'college_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $program = Program::find($id);
        $program->college_id = $input['college_id'];
        $program->name = $input['name'];
        $program->description = $input['description'];
        $program->save();

        return response([
            'message' => 'Program updated.',
            'data' => [
                'program' => $program
            ]
        ], 200);
    }

    /**
     * Delete Program
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $program = Program::find($id);
        $program->delete();

        return response([
            'message' => 'Program deleted.',
        ], 200);
    }

    /**
     * Get Program Users
     *
     * @param int $id
     * @return Response
     */
    public function getUsers(Request $request, $id)
    {
        $programUsers = User::getProgramUsers($request, $id);

        return response([
            'message' => 'Program user retreived.',
            'data' => [
                'users' => $programUsers
            ]
        ], 200);
    }

    /**
     * Get Total Action Plans By Status
     *
     * @param int $id
     * @return Response
     */
    public function getTotalActionPlansByStatus($id)
    {
        $actionPlans = ActionPlan::getTotalProgramActionPlansByStatus($id);

        return response([
            'message' => 'Total action plans per program.',
            'data' => $actionPlans
        ], 200);
    }
}

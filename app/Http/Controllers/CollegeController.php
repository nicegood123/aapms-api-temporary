<?php

namespace App\Http\Controllers;

use App\Constants\UserRole;
use App\Models\College;
use App\Models\User;
use App\Models\Report;
use App\Models\ActionPlan;
use App\Models\Program;
use Illuminate\Http\Request;
use Validator;

class CollegeController extends Controller
{

    /**
     * Get Colleges
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $query = College::whereRaw(
            '(name LIKE ? OR description LIKE ?)',
            [
                '%' . $request->search . '%',
                '%' . $request->search . '%'
            ]
        );

        $colleges = $query->latest()->paginate(10);

        foreach ($colleges as $college) {
            $college->count = Report::getTotalActionPlansByStatus($request, $college->id, "College");
        }

        if (!$colleges) {
            return response([
                'message' => 'Colleges not found.',
            ], 404);
        }

        return response([
            'message' => 'Colleges retreived.',
            'data' => [
                'colleges' => $colleges,
            ]
        ], 200);
    }

    /**
     * Get College Action Plans
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function getActionPlans(Request $request, $id)
    {
        $actionPlans = ActionPlan::getActionPlansByCollegeId($id, $request);

        if (!$actionPlans) {
            return response([
                'message' => 'College action plans not found.',
            ], 404);
        }

        foreach ($actionPlans as $actionPlan) {
            $actionPlan = ActionPlan::mapData($actionPlan);
        }

        return response([
            'message' => 'College action plans retreived.',
            'data' => [
                'action_plans' => $actionPlans,
            ]
        ], 200);
    }

    /**
     * Get Colleges Programs
     * 
     * @param $id
     * @return Response
     */
    public function getPrograms(Request $request, $id)
    {
        return response([
            'message' => 'Colleges retreived.',
            'data' => [
                'programs' => Program::getProgramsByCollegeId($id, $request),
            ]
        ], 200);
    }

    /**
     * Get College
     * 
     * @param $id
     */
    public function show($id, Request $request)
    {
        $college = College::find($id);
        $college->count = Report::getTotalActionPlansByStatus($request, $id, "College");

        return response([
            'message' => 'College retreived.',
            'data' => [
                'college' => $college,
            ]
        ], 200);
    }

    /**
     * Store College
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:colleges,name',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'College added.',
            'data' => [
                'college' => College::create($input)
            ]
        ], 200);
    }

    /**
     * Update College
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $college = College::find($id);
        $college->name = $input['name'];
        $college->description = $input['description'];
        $college->save();

        return response([
            'message' => 'College updated.',
            'data' => [
                'college' => $college
            ]
        ], 200);
    }


    /**
     * Delete College
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $college = College::find($id);
        $college->delete();

        return response([
            'message' => 'College deleted.',
        ], 200);
    }

    /**
     * Get College Users
     *
     * @param Request $request, $id
     * @return Response
     */
    public function getUsers(Request $request, $id)
    {
        $collegeUsers = User::getCollegeUsers($request, $id);

        return response([
            'message' => 'College user retreived.',
            'data' => [
                'users' => $collegeUsers
            ]
        ], 200);
    }
}

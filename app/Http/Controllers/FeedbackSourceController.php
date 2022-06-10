<?php

namespace App\Http\Controllers;

use App\Models\FeedbackSource;
use Illuminate\Http\Request;
use Validator;

class FeedbackSourceController extends Controller
{

    /**
     * Get Feedback Sources
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = FeedbackSource::where('name', 'LIKE', '%' . $request->search . '%');

        $feedbackSources = $query->latest()->paginate(20);

        return response([
            'message' => 'Feedback sources retreived.',
            'data' => [
                'feedback_sources' => $feedbackSources,
            ]
        ], 200);
    }


    /**
     * Get Feedback Source Details
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $feedbackSource = FeedbackSource::find($id);

        return response([
            'message' => 'Feedback source retreived.',
            'data' => [
                'feedback_source' => $feedbackSource,
            ]
        ], 200);
    }


    /**
     * Add Feedback Source
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|unique:feedback_sources,name',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'Feedback source added.',
            'data' => [
                'feedback_source' => FeedbackSource::create($input)
            ]
        ], 200);
    }

    /**
     * Update Feedback Source
     * 
     * @param Request $request, $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $feedbackSource = FeedbackSource::find($id);
        $feedbackSource->name = $input['name'];
        $feedbackSource->save();

        return response([
            'message' => 'Feedback source updated.',
            'data' => [
                'feedback_source' => $feedbackSource
            ]
        ], 200);
    }

    /**
     * Delete Feedback Source
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $feedbackSource = FeedbackSource::find($id);
        $feedbackSource->delete();

        return response([
            'message' => 'Feedback source deleted.',
        ], 200);
    }
}

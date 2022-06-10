<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    /**
     * Get Conversations
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $conversations = Conversation::where('name', 'LIKE', '%' . $request->search . '%')
            ->latest()->paginate(20);

        if (!$conversations) {
            return response([
                'message' => 'No conversations yet.',
                'data' => []
            ], 404);
        }

        foreach ($conversations as $conversation) {
            $conversation->create_by = User::find($conversation->user_id);
        }

        return response([
            'message' => 'Conversations retreived.',
            'data' => [
                'conversations' => $conversations,
            ]
        ], 200);
    }

    public function show($id)
    {
        $conversation = Conversation::find($id);

        return response([
            'message' => 'Conversation retreived.',
            'data' => [
                'conversation' => $conversation,
            ]
        ], 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'Conversation added.',
            'data' => [
                'conversation' => Conversation::create($input)
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $conversation = Conversation::find($id);
        $conversation->name = $input['name'];
        $conversation->user_id = $input['user_id'];
        $conversation->save();

        return response([
            'message' => 'Conversation updated.',
            'data' => [
                'conversation' => $conversation
            ]
        ], 200);
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id);
        $conversation->delete();

        return response([
            'message' => 'Conversation deleted.',
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $conversation = Conversation::find($id);
        $conversation->status = $request->status;
        $conversation->save();

        return response([
            'message' => 'Status updated.'
        ], 200);
    }
}

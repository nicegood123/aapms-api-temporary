<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Validator;



class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('content', 'LIKE', '%' . $request->search . '%')
            ->latest()->paginate(20);

        return response([
            'message' => 'Messages retreived.',
            'data' => [
                'messages' => $messages,
            ]
        ], 200);
    }

    public function show($id)
    {
        $message = Message::find($id);

        return response([
            'message' => 'Message retreived.',
            'data' => [
                'message' => $message,
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'content' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'conversation_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'Message added.',
            'data' => [
                'nessage' => Message::create($input)
            ]
        ], 200);
    }

    public function delete($id)
    {
        $message = Message::find($id);
        $message->delete();

        return response([
            'message' => 'Message deleted.',
        ], 200);
    }
}

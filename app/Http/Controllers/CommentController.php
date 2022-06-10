<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Get Comments
     * 
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $comments = Comment::where('action_plan_id', $id)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        if (!$comments) {
            return response([
                'message' => 'No comments yet.',
            ], 200);
        }

        foreach ($comments as $comment) {
            $comment->commented_by = User::find($comment->user_id);
        }

        return response([
            'message' => 'Comments retreived.',
            'data' => [
                'comments' => $comments
            ]
        ], 200);
    }

    /**
     * Create Comment
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'action_plan_id' => 'required',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 404);
        }

        $comment = [
            'action_plan_id' => $request->action_plan_id,
            'user_id' => auth()->user()->id,
            'content' => $request->content
        ];

        Comment::create($comment);

        return response([
            'message' => 'Comment added.',
            'data' => [
                'comments' => $comment
            ]
        ], 200);
    }

    /**
     * Create Comment
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response([
            'message' => 'Comment deleted.',
        ], 200);
    }
}

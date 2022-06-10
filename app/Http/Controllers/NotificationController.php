<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{

    /**
     * Get Notifications
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Notification::where('user_id', '=', auth()->user()->id);

        if ($request->search) {
            $query->where('content', 'LIKE', '%' . $request->search . '%');
        }

        $notifications = $query->latest()->paginate(20);

        return response([
            'message' => 'Notifications retreived.',
            'query' => 'asdftest',
            'data' => [
                'notifications' => $notifications,
            ]
        ], 200);
    }

    /**
     * Get Notification Details
     * 
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        return response([
            'message' => 'Notification retreived.',
            'data' => [
                'notification' => $notification,
            ]
        ], 200);
    }

    /**
     * Add Notification
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'content' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first(),
            ], 400);
        }

        return response([
            'message' => 'Notification added.',
            'data' => [
                'notification' => Notification::create($input)
            ]
        ], 200);
    }

    /**
     * Delete Notification
     * 
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return response([
            'message' => 'Notification deleted.',
        ], 200);
    }

    /**
     * Update Notification Status
     *
     * @param Requst $request
     * @param int $id
     * @return Response
     */
    public function updateStatus($id)
    {
        $notification = Notification::find($id);
        $notification->status = 'Read';
        $notification->save();

        return response([
            'message' => 'Status updated.'
        ], 200);
    }
}

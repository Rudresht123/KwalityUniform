<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notificationId = $request->id;

        if ($notificationId) {
            auth()->user()->unreadNotifications->where('id', $notificationId)->markAsRead();
        } else {
            auth()->user()->unreadNotifications->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function hide(Request $request)
    {
        $notification = auth()->user()->unreadNotifications()->where('id', $request->notification_id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}

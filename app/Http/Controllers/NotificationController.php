<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $notifications = auth()->user()->notifications->map(function ($notification) {
            $notificationData = $notification->data;

            // Add the status_icon for student notifications
            if (auth()->user()->user_type === 'student') {
                $notificationData['status_icon'] = $notificationData['status'] === 'approved' ? 'approved' : 'rejected';
            }

            return [
                'id' => $notification->id,
                'student_name' => $notificationData['student_name'],
                'image_path' => isset($notificationData['image_path']) ? asset(path: $notificationData['image_path']) : '',
                'message' => $notificationData['message'],
                'created_at' => $notification->created_at->toDateTimeString(),
                'read_at' => !empty($notification->read_at) ? true : false,
                'status_icon' => $notificationData['status_icon'] ?? '', // Optional field for students
                'user_type' => auth()->user()->user_type // Include user type to differentiate
            ];
        });

        return response()->json($notifications);
    }




public function markAllAsRead(Request $request)
{
    $user = auth()->user();

    // Mark all unread notifications as read
    $user->unreadNotifications->markAsRead();

    return response()->json(['success' => true]);
}

public function markAsRead($notificationId)
{
    $notification = auth()->user()->notifications()->find($notificationId);

    if ($notification) {
        $notification->markAsRead();
    }

    return response()->json(['status' => 'success']);
}


public function show($notificationId)
{
  
$notificationsdata = DB::table('notifications')
    ->where('id', $notificationId) // Filter by notification ID
    ->first();



    $notification = auth()->user()->notifications()->find($notificationId);

    if ($notification) {
        $notification->markAsRead();
    }

      return view("notifications.index", compact('notificationsdata'));
}
    

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    /**
     * Mark as read
     *
     * @param DatabaseNotification $notification
     * @return void
     */
    public function __invoke(DatabaseNotification $notification)
    {
        $this->authorize('update', $notification);
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notification marked as read');
    }
}

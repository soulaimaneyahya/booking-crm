<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Response;

class NotificationController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia(
            'Notifications/Index', [
                'notifications' => $request->user()
                    ->notifications()->paginate(10)
            ]
        );
    }
}

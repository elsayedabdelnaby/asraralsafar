<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Notifications\FirebaseNotification;
use App\Notifications\NotificationContext;
use App\Notifications\PusherNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function send(Request $request)
    {
        $ip = $request->ip();
        $message = $request->get('message');
        $method = $request->get('method');
        $token = $request->get('token') ?? null;
        $user_id = auth()->user()->getAuthIdentifier() ?? null;

        Notification::create([
            'ip' => $ip,
            'token' => $token,
            'user_id' => $user_id,
            'message' => $message,
        ]);

        if ($method === 'firebase')
            $context = new NotificationContext(new FirebaseNotification);
        else
            $context = new NotificationContext(new PusherNotification('event', 'channel'));

        $context->sendNotification($message);

        return true;
    }
}

<?php

namespace App\Notifications;

use App\Http\Interfaces\NotificationInterface;

class PusherNotification implements NotificationInterface
{
    private $event;
    private $channel;

    public function __construct($event, $channel)
    {
        $this->channel = $channel;
        $this->event = $event;
    }

    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

    public function setEvent($event): void
    {
        $this->event = $event;
    }

    public function send(string $message): void
    {
        $pusher = new Pusher\Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );
        $data['message'] = $message;
        $pusher->trigger($this->channel, $this->event, $data);
    }
}

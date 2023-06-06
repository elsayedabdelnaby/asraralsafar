<?php

namespace App\Notifications;

use App\Http\Interfaces\NotificationInterface;

class NotificationContext
{
    private NotificationInterface $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function setNotification(NotificationInterface $notification): void
    {
        $this->notification = $notification;
    }

    public function sendNotification(string $message): void
    {
        $this->notification->send($message);
    }
}

<?php

namespace App\Notifications;

use App\Http\Interfaces\NotificationInterface;
use App\Models\User;

class FirebaseNotification implements NotificationInterface
{

    public function send(string $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = "BNFMeW2xOONxhGlQ6cHeXBpm8N65iVad20sR_oA7qdDarTRcApCiZE_DNJvsyxCHq7dcxbW6dVZolAP5KgBV_Bw";
        $headers = [
            'Authorization: key=' . $server_key,
            'Content-Type: application/json'
        ];
        $fields = [
            'to' => '/topics/all',
            'notification' => [
                'title' => 'Notification Title',
                'body' => $message,
                'sound' => 'default'
            ]
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }
}

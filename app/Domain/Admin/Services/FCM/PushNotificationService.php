<?php

namespace App\Domain\Admin\Services\FCM;

use Edujugon\PushNotification\Facades\PushNotification;

class PushNotificationService
{
    public function sendPushNotificationByTopic($notification)
    {
        PushNotification::setService('fcm')
            ->setMessage($notification)
            ->setApiKey(config('palika.appApiKey'))
            ->setConfig(['dry_run' => false])
            ->sendByTopic(config('palika.androidTopic'));
    }
}
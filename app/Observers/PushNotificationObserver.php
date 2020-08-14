<?php

namespace App\Observers;

use App\EBP\Entities\PublicProcurement;
use App\EBP\Entities\PushNotification;

class PushNotificationObserver
{
    /**
     * @param PushNotification $pushNotification
     */
    public function created(PushNotification $pushNotification)
    {
        $pushNotification->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param PushNotification $pushNotification
     */
    public function updated(PushNotification $pushNotification)
    {
        $pushNotification->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param PushNotification $pushNotification
     */
    public function deleted(PushNotification $pushNotification)
    {
        $pushNotification->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
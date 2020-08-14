<?php

namespace App\Observers;


use App\EBP\Entities\PhoneNumber;

class PhoneNumberObserver
{
    /**
     * @param PhoneNumber $phoneNumber
     */
    public function created(PhoneNumber $phoneNumber)
    {
        $phoneNumber->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function updated(PhoneNumber $phoneNumber)
    {
        $phoneNumber->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function deleted(PhoneNumber $phoneNumber)
    {
        $phoneNumber->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
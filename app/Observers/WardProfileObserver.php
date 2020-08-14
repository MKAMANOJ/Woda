<?php

namespace App\Observers;


use App\EBP\Entities\WardProfile;

class WardProfileObserver
{
    /**
     * @param WardProfile $profile
     */
    public function created(WardProfile $profile)
    {
        $profile->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param WardProfile $profile
     */
    public function updated(WardProfile $profile)
    {
        $profile->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param WardProfile $profile
     */
    public function deleted(WardProfile $profile)
    {
        $profile->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
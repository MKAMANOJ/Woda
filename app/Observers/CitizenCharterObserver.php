<?php

namespace App\Observers;

use App\EBP\Entities\CitizenCharter;

class CitizenCharterObserver
{
    /**
     * @param CitizenCharter $charter
     */
    public function created(CitizenCharter $charter)
    {
        $charter->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param CitizenCharter $charter
     */
    public function updated(CitizenCharter $charter)
    {
        $charter->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param CitizenCharter $charter
     */
    public function deleted(CitizenCharter $charter)
    {
        $charter->histories()->create([
            'body' => 'deleted',
        ]);
    }
}

<?php

namespace App\Observers;

use App\EBP\Entities\WasteBusRoutine;

class WasteBusRoutineObserver
{
    /**
     * @param Introduction $introduction
     */
    public function updated(WasteBusRoutine $wasteBusRoutine)
    {
        $wasteBusRoutine->histories()->create([
            'body' => 'updated',
        ]);
    }
}
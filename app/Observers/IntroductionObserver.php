<?php

namespace App\Observers;

use App\EBP\Entities\Introduction;

class IntroductionObserver
{
    /**
     * @param Introduction $introduction
     */
    public function updated(Introduction $introduction)
    {
        $introduction->histories()->create([
            'body' => 'updated',
        ]);
    }
}
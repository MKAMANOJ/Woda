<?php

namespace App\Observers;

use App\EBP\Entities\Home;

class HomeObserver
{
    /**
     * @param Introduction $introduction
     */
    public function updated(Home $home)
    {
        $home->histories()->create([
            'body' => 'updated',
        ]);
    }
}
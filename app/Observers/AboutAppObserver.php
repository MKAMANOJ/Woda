<?php

namespace App\Observers;

use App\EBP\Entities\AboutApp;

class AboutAppObserver
{

    /**
     * @param AboutApp $aboutApp
     */
    public function updated(AboutApp $aboutApp)
    {
        $aboutApp->histories()->create([
            'body' => 'updated',
        ]);
    }
}

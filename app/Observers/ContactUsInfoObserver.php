<?php

namespace App\Observers;

use App\EBP\Entities\ContactUsInfo;

class ContactUsInfoObserver
{
    /**
     * @param ContactUsInfo $info
     */
    public function updated(ContactUsInfo $info)
    {
        $info->histories()->create([
            'body' => 'updated',
        ]);
    }
}

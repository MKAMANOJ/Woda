<?php

namespace App\Observers;

use App\EBP\Entities\PublicProcurement;

class PublicProcurementObserver
{
    /**
     * @param PublicProcurement $procurement
     */
    public function created(PublicProcurement $procurement)
    {
        $procurement->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param PublicProcurement $procurement
     */
    public function updated(PublicProcurement $procurement)
    {
        $procurement->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param PublicProcurement $procurement
     */
    public function deleted(PublicProcurement $procurement)
    {
        $procurement->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
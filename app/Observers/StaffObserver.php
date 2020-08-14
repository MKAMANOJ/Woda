<?php

namespace App\Observers;


use App\EBP\Entities\Staff;

class StaffObserver
{
    /**
     * @param Staff $staff
     */
    public function created(Staff $staff)
    {
        $staff->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param Staff $staff
     */
    public function updated(Staff $staff)
    {
        $staff->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param Staff $staff
     */
    public function deleted(Staff $staff)
    {
        $staff->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
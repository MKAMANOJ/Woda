<?php

namespace App\Observers;

use App\EBP\Entities\Report;

class ReportObserver
{
    /**
     * @param Report $reports
     */
    public function created(Report $reports)
    {
        $reports->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param Report $reports
     */
    public function updated(Report $reports)
    {
        $reports->histories()->create([
            'body' => 'updated',
        ]);
    }

    public function deleted(Report $reports)
    {
        $reports->histories()->create([
            'body' => 'deleted',
        ]);
    }
}

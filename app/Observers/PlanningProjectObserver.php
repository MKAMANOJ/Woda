<?php

namespace App\Observers;

use App\EBP\Entities\PlanningProject;

class PlanningProjectObserver
{
    /**
     * @param PlanningProject $planningProject
     */
    public function created(PlanningProject $planningProject)
    {
        $planningProject->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param PlanningProject $planningProject
     */
    public function updated(PlanningProject $planningProject)
    {
        $planningProject->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param PlanningProject $planningProject
     */
    public function deleted(PlanningProject $planningProject)
    {
        $planningProject->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
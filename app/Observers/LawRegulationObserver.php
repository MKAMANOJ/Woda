<?php

namespace App\Observers;

use App\EBP\Entities\LawRegulation;

class LawRegulationObserver
{
    /**
     * @param LawRegulation $lawRegulation
     */
    public function created(LawRegulation $lawRegulation)
    {
        $lawRegulation->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param LawRegulation $lawRegulation
     */
    public function updated(LawRegulation $lawRegulation)
    {
        $lawRegulation->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param LawRegulation $lawRegulation
     */
    public function deleted(LawRegulation $lawRegulation)
    {
        $lawRegulation->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
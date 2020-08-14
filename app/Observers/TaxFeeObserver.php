<?php

namespace App\Observers;

use App\EBP\Entities\TaxFee;

class TaxFeeObserver
{
    /**
     * @param TaxFee $taxFee
     */
    public function created(TaxFee $taxFee)
    {
        $taxFee->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param TaxFee $taxFee
     */
    public function updated(TaxFee $taxFee)
    {
        $taxFee->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param TaxFee $taxFee
     */
    public function deleted(TaxFee $taxFee)
    {
        $taxFee->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
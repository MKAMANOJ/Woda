<?php

namespace App\Observers;

use App\EBP\Entities\BudgetProgram;

class BudgetProgramObserver
{
    /**
     * @param BudgetProgram $budgetProgram
     */
    public function created(BudgetProgram $budgetProgram)
    {
        $budgetProgram->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param BudgetProgram $budgetProgram
     */
    public function updated(BudgetProgram $budgetProgram)
    {
        $budgetProgram->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param BudgetProgram $budgetProgram
     */
    public function deleted(BudgetProgram $budgetProgram)
    {
        $budgetProgram->histories()->create([
            'body' => 'deleted',
        ]);
    }
}

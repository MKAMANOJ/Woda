<?php

namespace App\Observers;

use App\EBP\Entities\ImportantContact\ImportantContactCategory;

class ImportantContactCategoryObserver
{
    /**
     * @param ImportantContactCategory $category
     */
    public function created(ImportantContactCategory $category)
    {
        $category->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param ImportantContactCategory $category
     */
    public function updated(ImportantContactCategory $category)
    {
        $category->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param ImportantContactCategory $category
     */
    public function deleted(ImportantContactCategory $category)
    {
        $category->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
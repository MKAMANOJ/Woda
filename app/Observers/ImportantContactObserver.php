<?php

namespace App\Observers;

use App\EBP\Entities\ImportantContact\ImportantContact;

class ImportantContactObserver
{
    /**
     * @param ImportantContact $contact
     */
    public function created(ImportantContact $contact)
    {
        $contact->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param ImportantContact $contact
     */
    public function updated(ImportantContact $contact)
    {
        $contact->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param ImportantContact $contact
     */
    public function deleted(ImportantContact $contact)
    {
        $contact->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
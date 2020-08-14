<?php

namespace App\EBP\Repositories\ImportantContact\Contact;

use App\EBP\Entities\ImportantContact\ImportantContact;
use App\EBP\Repositories\BaseRepository;

class ImportantContactRepository extends BaseRepository implements IImportantContactRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImportantContact::class;
    }
}
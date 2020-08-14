<?php

namespace App\EBP\Repositories\EmailTemplates;

/**
 * Interface IEmailTemplateRepository
 * @package App\EBP\Repositories\EmailTemplates
 */
interface IEmailTemplateRepository
{
    /**
     * Create new Email Template in the storage.
     *
     * @param array $inputData
     * @return mixed
     */
    public function create(array $inputData);

}

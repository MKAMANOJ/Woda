<?php

namespace App\EBP\Repositories\EmailTemplates;

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use App\EBP\Repositories\BaseRepository;

/**
 * Class EmailTemplateRepository
 * @package App\EBP\Repositories\EmailTemplates
 */
class EmailTemplateRepository extends BaseRepository implements IEmailTemplateRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailTemplate::class;
    }

    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllEmailTemplateForDataTable()
    {
        return $this->model->select('id', 'title', 'created_at');
    }
}

<?php

namespace App\Domain\Admin\Services\EmailTemplates;

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use App\EBP\Repositories\EmailTemplates\IEmailTemplateRepository;

/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class EmailTemplatesService
{
    /**
     * @var IEmailTemplateRepository
     */
    protected $emailTemplateRepository;

    /**
     * EmailTemplatesService constructor.
     * @param $emailTemplateRepository
     */
    public function __construct(IEmailTemplateRepository $emailTemplateRepository)
    {
        $this->emailTemplateRepository = $emailTemplateRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return EmailTemplate
     */
    public function store(array $inputData): EmailTemplate
    {
        return $this->emailTemplateRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return EmailTemplate
     * @throws \Exception
     */
    public function getById(int $id): EmailTemplate
    {
        return $this->emailTemplateRepository->find($id);
    }

    /**
     * Returns the specific Email Template by given slug.
     *
     * @param string $slug
     * @return EmailTemplate
     * @internal param int $id
     */
    public function getBySlug(string $slug): EmailTemplate
    {
        return $this->emailTemplateRepository->findWhere(['slug' => $slug])->first();
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return EmailTemplate
     */
    public function updateEmailTemplate(int $id, array $updateData): EmailTemplate
    {
        return $this->emailTemplateRepository->update($updateData, $id);
    }

    /**
     * Returns all the email templates.
     *
     * @return mixed
     */
    public function allEmailTemplateForDataTable()
    {
        return $this->emailTemplateRepository->getAllEmailTemplateForDataTable();
    }

}

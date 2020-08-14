<?php

namespace App\Domain\Admin\Services\ContactUsInfo;

use App\EBP\Entities\ContactUsInfo;
use App\EBP\Repositories\ContactUsInfo\IContactUsInfoRepository;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class ContactUsInfoService
{
    /**
     * @var IContactUsInfoRepository
     */
    protected $contactUsInfoRepository;

    /**
     * EmailTemplatesService constructor.
     * @param IContactUsInfoRepository $contactUsInfoRepository
     */
    public function __construct(IContactUsInfoRepository $contactUsInfoRepository)
    {
        $this->contactUsInfoRepository = $contactUsInfoRepository;
    }

    /**
     * Returns the details of contact info.
     * @return ContactUsInfo
     */
    public function getContactInfoDetail()
    {
        return $this->contactUsInfoRepository->getInfo();
    }

    /**
     * Updates the contact info
     *
     * @param array $updateData
     * @return ContactUsInfo
     */
    public function updateContactUsInfo(array $updateData)
    {
        return $this->contactUsInfoRepository->updateInfo($updateData);
    }
}

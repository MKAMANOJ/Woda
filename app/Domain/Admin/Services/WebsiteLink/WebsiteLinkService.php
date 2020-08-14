<?php

namespace App\Domain\Admin\Services\WebsiteLink;

use App\EBP\Entities\WebsiteLink;
use App\EBP\Repositories\WebsiteLink\WebsiteLinkRepository;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class WebsiteLinkService
{
    /**
     * @var IWebsiteLinkRepository
     */
    protected $websiteLinkRepository;

    /**
     * GalleryImageService constructor.
     * @param IWebsiteLinkRepository $websiteLinkRepository
     */
    public function __construct(WebsiteLinkRepository $websiteLinkRepository)
    {
        $this->websiteLinkRepository = $websiteLinkRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return WebsiteLink
     */
    public function store(array $inputData): WebsiteLink
    {
        return $this->websiteLinkRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return WebsiteLink
     * @throws \Exception
     */
    public function getById(int $id): WebsiteLink
    {
        return $this->websiteLinkRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return WebsiteLink
     */
    public function update(int $id, array $updateData): WebsiteLink
    {
        return $this->websiteLinkRepository->update($updateData, $id);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->websiteLinkRepository->delete($id);
    }

    /**
     * Returns All Staffs For DataTable
     */
    public function getAllForDataTable()
    {
        return $this->websiteLinkRepository->getAll($dataTable = true);
    }
}

<?php

namespace App\Domain\Admin\Services\ImportantContact;
use App\EBP\Entities\ImportantContact\ImportantContactCategory;
use App\EBP\Repositories\ImportantContact\Category\IImportantContactCategoryRepository;


/**
 * Class ImportantContactCategoryService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class ImportantContactCategoryService
{
    /**
     * @var IImportantContactCategoryRepository
     */
    protected $contactCategoryRepository;

    /**
     * EmailTemplatesService constructor.
     * @param IImportantContactCategoryRepository $contactCategoryRepository
     */
    public function __construct(IImportantContactCategoryRepository $contactCategoryRepository)
    {
        $this->contactCategoryRepository = $contactCategoryRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return ImportantContactCategory
     */
    public function store(array $inputData): ImportantContactCategory
    {
        return $this->contactCategoryRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return ImportantContactCategory
     * @throws \Exception
     */
    public function getById(int $id): ImportantContactCategory
    {
        return $this->contactCategoryRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return ImportantContactCategory
     */
    public function update(int $id, array $updateData): ImportantContactCategory
    {
        return $this->contactCategoryRepository->update($updateData, $id);
    }

    /**
     * Returns all the gallery categories for datatable.
     *
     * @return mixed
     */
    public function allGalleryCategoriesForDataTable()
    {
        return $this->contactCategoryRepository->getAllGalleryCategoriesForDataTable();
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->contactCategoryRepository->delete($id);
    }
}

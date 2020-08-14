<?php

namespace App\Domain\Admin\Services\ImportantContact;

use App\EBP\Entities\ImportantContact\ImportantContact;
use App\EBP\Repositories\ImportantContact\Contact\IImportantContactRepository;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class ImportantContactService
{
    /**
     * @var IImportantContactRepository
     */
    private $contactRepository;
    /**
     * @var ImportantContactCategoryService
     */
    private $categoryService;


    /**
     * GalleryImageService constructor.
     * @param IImportantContactRepository     $contactRepository
     * @param ImportantContactCategoryService $categoryService
     */
    public function __construct(IImportantContactRepository $contactRepository, ImportantContactCategoryService $categoryService)
    {
        $this->contactRepository = $contactRepository;
        $this->categoryService   = $categoryService;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return ImportantContact
     */
    public function store(array $inputData): ImportantContact
    {
        $category = $this->categoryService->getById($inputData['important_contact_category_id']);
        if (isset($inputData['image'])) {
            $inputData['image'] = upload($inputData['image'], $category->name);
        }

        return $this->contactRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return ImportantContact
     * @throws \Exception
     */
    public function getById(int $id): ImportantContact
    {
        return $this->contactRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int     $id
     * @param Request $request
     * @return ImportantContact
     * @internal param array $updateData
     */
    public function update(int $id, Request $request): ImportantContact
    {
        $category = $this->categoryService->getById($request['important_contact_category_id']);
        if ($request->hasFile('image')) {
            $request['image'] = upload($request['image'], $category->name);
        }

        return $this->contactRepository->update($request->all(), $id);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->contactRepository->delete($id);
    }
}

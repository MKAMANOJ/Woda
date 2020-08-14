<?php

namespace App\Domain\Admin\Services\File;

use App\EBP\Entities\FileCategory;
use App\EBP\Repositories\File\Category\IFileCategoryRepository;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class FileCategoryService
{
    /**
     * @var IFileCategoryRepository
     */
    private $fileCategoryRepository;


    /**
     * FileCategoryService constructor.
     * @param IFileCategoryRepository $fileCategoryRepository
     */
    public function __construct(IFileCategoryRepository $fileCategoryRepository)
    {
        $this->fileCategoryRepository = $fileCategoryRepository;
    }

    /**
     *  Store a newly created File Category in the storage.
     *
     * @param array $inputData
     * @return FileCategory
     */
    public function store(array $inputData): FileCategory
    {
        return $this->fileCategoryRepository->create($inputData);
    }

    /**
     * Returns the specific File Category by given id.
     *
     * @param int $id
     * @return FileCategory
     * @throws \Exception
     */
    public function getById(int $id): FileCategory
    {
        return $this->fileCategoryRepository->find($id);
    }

    /**
     * Returns the specific File Category by given slug.
     *
     * @param string $slug
     * @return FileCategory
     */
    public function getBySlug(string $slug)
    {
        return $this->fileCategoryRepository->findBySlug($slug);
    }

    /**
     * Updates the File Category of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return FileCategory
     */
    public function update(int $id, array $updateData): FileCategory
    {
        return $this->fileCategoryRepository->update($updateData, $id);
    }

    /**
     * Returns all the gallery categories for datatable.
     *
     * @return mixed
     */
    public function allFileCategoriesForDataTable()
    {
        return $this->fileCategoryRepository->getAllFileCategoriesForDataTable();
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->fileCategoryRepository->delete($id);
    }
}

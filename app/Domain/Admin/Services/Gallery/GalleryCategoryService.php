<?php

namespace App\Domain\Admin\Services\Gallery;

use App\EBP\Entities\GalleryCategory;
use App\EBP\Repositories\Gallery\Category\IGalleryCategoryRepository;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class GalleryCategoryService
{
    /**
     * @var IGalleryCategoryRepository
     */
    protected $galleryCategoryRepository;

    /**
     * EmailTemplatesService constructor.
     * @param IGalleryCategoryRepository $galleryCategoryRepository
     * @internal param $emailTemplateRepository
     */
    public function __construct(IGalleryCategoryRepository $galleryCategoryRepository)
    {
        $this->galleryCategoryRepository = $galleryCategoryRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return GalleryCategory
     */
    public function store(array $inputData): GalleryCategory
    {
        return $this->galleryCategoryRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return GalleryCategory
     * @throws \Exception
     */
    public function getById(int $id): GalleryCategory
    {
        return $this->galleryCategoryRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return GalleryCategory
     */
    public function update(int $id, array $updateData): GalleryCategory
    {
        return $this->galleryCategoryRepository->update($updateData, $id);
    }

    /**
     * Returns all the gallery categories for datatable.
     *
     * @return mixed
     */
    public function allGalleryCategoriesForDataTable()
    {
        return $this->galleryCategoryRepository->getAllGalleryCategoriesForDataTable();
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->galleryCategoryRepository->delete($id);
    }
}

<?php

namespace App\Domain\Admin\Services\Gallery;

use App\EBP\Entities\GalleryImage;
use App\EBP\Repositories\Gallery\Image\IGalleryImageRepository;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class GalleryImageService
{
    /**
     * @var IGalleryImageRepository
     */
    protected $imageRepository;
    /**
     * @var GalleryCategoryService
     */
    protected $categoryService;

    /**
     * GalleryImageService constructor.
     * @param IGalleryImageRepository $imageRepository
     * @param GalleryCategoryService  $categoryService
     */
    public function __construct(IGalleryImageRepository $imageRepository, GalleryCategoryService $categoryService)
    {
        $this->imageRepository = $imageRepository;
        $this->categoryService = $categoryService;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return GalleryImage
     */
    public function store(array $inputData): GalleryImage
    {
        $category = $this->categoryService->getById($inputData['gallery_category_id']);
        if ($inputData['image']) {
            $inputData['name']              = upload($inputData['image'], $category->name);
            $inputData['original_filename'] = $inputData['image']->getClientOriginalName();
            $inputData                      = array_except($inputData, ['image']);
        }

        return $this->imageRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return GalleryImage
     * @throws \Exception
     */
    public function getById(int $id): GalleryImage
    {
        return $this->imageRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int     $id
     * @param Request $request
     * @return GalleryImage
     * @internal param array $updateData
     */
    public function update(int $id, Request $request): GalleryImage
    {
        $category = $this->categoryService->getById($request['gallery_category_id']);
        if ($request->hasFile('image')) {
            $request['name']              = upload($request['image'], $category->name);
            $request['original_filename'] = $request['image']->getClientOriginalName();
        }
        $request = array_except($request->all(), ['image']);

        return $this->imageRepository->update($request, $id);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->imageRepository->delete($id);
    }
}

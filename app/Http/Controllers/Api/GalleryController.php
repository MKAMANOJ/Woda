<?php

namespace App\Http\Controllers\Api;

use App\Domain\Admin\Services\Gallery\GalleryCategoryService;
use App\EBP\Entities\GalleryImage;
use App\EBP\Transformers\AbstractTransformer;
use App\EBP\Transformers\GalleryCategoryTransformer;
use App\EBP\Transformers\GalleryImageTransformer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryController extends AbstractTransformer
{
    /**
     * @var GalleryCategoryService
     */
    protected $categoryService;
    /**
     * @var Fractal\Manager
     */
    protected $fractal;
    /**
     * @var GalleryImageTransformer
     */
    protected $galleryImageTransformer;
    /**
     * @var GalleryCategoryTransformer
     */
    protected $categoryTransformer;

    /**
     * GalleryController constructor.
     * @param GalleryCategoryService     $categoryService
     * @param Fractal\Manager            $fractal
     * @param GalleryImageTransformer    $galleryImageTransformer
     * @param GalleryCategoryTransformer $categoryTransformer
     */
    function __construct(GalleryCategoryService $categoryService, Fractal\Manager $fractal, GalleryImageTransformer $galleryImageTransformer, GalleryCategoryTransformer $categoryTransformer)
    {
        $this->categoryService         = $categoryService;
        $this->fractal                 = $fractal;
        $this->galleryImageTransformer = $galleryImageTransformer;
        $this->categoryTransformer     = $categoryTransformer;
    }

    /**
     * Returns all the categories for api.
     * @param Request $request
     * @return array
     */
    public function getAllCategories(Request $request)
    {
        try {
            $lastSyncDate = $request['last_sync_date'] ? Carbon::parse($request['last_sync_date']) : '';
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 406,
                'message' => 'The date parameter is not in the correct format. The correct format is Y:m:d H:i:s.',
            ], 406);
        }
        try {
            $category['created'] = $this->getPaginatedResult($this->categoryService->allGalleryCategoriesForDataTable(), 'created_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.galleryCategoriesPerPageData'));
            $category['updated'] = $this->getPaginatedResult($this->categoryService->allGalleryCategoriesForDataTable(), 'updated_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.galleryCategoriesPerPageData'));
            $category['deleted'] = $this->getPaginatedResult($this->categoryService->allGalleryCategoriesForDataTable(), 'deleted_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.galleryCategoriesPerPageData'));
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 500,
                'message' => 'Error!! Please try again',
            ]);
        }
        $category['code']              = 200;
        $category['message']           = 'success';
        $category['current_date_time'] = Carbon::now();

        return $category;
    }

    /**
     * returns all the images of a category
     * @param         $id
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getAllImagesOfACategory($id, Request $request)
    {
        try {
            $lastSyncDate = $request['last_sync_date'] ? Carbon::parse($request['last_sync_date']) : '';
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 406,
                'message' => 'The date parameter is not in the correct format. The correct format is Y:m:d H:i:s.',
            ], 406);
        }
        try {
        } catch (Exception $exception) {
            return response()->json([
                'code'    => 405,
                'message' => 'The date parameter is not in the correct format. The correct format is Y:m:d H:i:s.',
            ]);
        }
        try {
            $category            = $this->categoryService->getById($id);
            $response['created'] = $this->getPaginatedResult($category->images(), 'created_at', $this->galleryImageTransformer, $lastSyncDate,
                config('palika.galleryImagesPageData'));
            $response['updated'] = $this->getPaginatedResult($category->images(), 'updated_at', $this->galleryImageTransformer, $lastSyncDate,
                config('palika.galleryImagesPageData'));
            $response['deleted'] = $this->getPaginatedResult($category->images(), 'deleted_at', $this->galleryImageTransformer, $lastSyncDate,
                config('palika.galleryImagesPageData'));
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            throw $exception;
        }
        $response['code']              = 200;
        $response['message']           = 'success';
        $response['current_date_time'] = Carbon::now()->format('Y:m:d H:i:s');

        return $response;
    }
}

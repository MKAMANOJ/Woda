<?php

namespace App\Http\Controllers\Api;

use App\Domain\Admin\Services\File\FileCategoryService;
use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Transformers\AbstractTransformer;
use App\EBP\Transformers\File\FileCategoryTransformer;
use App\EBP\Transformers\File\UploadedFileTransformer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use League\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Http\Request;

class FileController extends AbstractTransformer
{
    /**
     * @var FileCategoryService
     */
    protected $categoryService;
    /**
     * @var UploadedFileService
     */
    protected $uploadedFileService;
    /**
     * @var Fractal\Manager
     */
    protected $fractal;
    /**
     * @var FileCategoryTransformer
     */
    protected $categoryTransformer;
    /**
     * @var UploadedFileTransformer
     */
    protected $uploadedFileTransformer;

    /**
     * @param FileCategoryService     $categoryService
     * @param UploadedFileService     $uploadedFileService
     * @param Fractal\Manager         $fractal
     * @param FileCategoryTransformer $categoryTransformer
     * @param UploadedFileTransformer $uploadedFileTransformer
     */
    function __construct(
        FileCategoryService $categoryService,
        UploadedFileService $uploadedFileService,
        Fractal\Manager $fractal,
        FileCategoryTransformer $categoryTransformer,
        UploadedFileTransformer $uploadedFileTransformer
    ) {

        $this->categoryService         = $categoryService;
        $this->uploadedFileService     = $uploadedFileService;
        $this->fractal                 = $fractal;
        $this->categoryTransformer     = $categoryTransformer;
        $this->uploadedFileTransformer = $uploadedFileTransformer;
    }

    /**
     * Returns all the categories for API.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllFileCategories(Request $request)
    {
        $lastSyncDate = $request['last_sync_date'] ? Carbon::parse($request['last_sync_date']) : '';
        try {
            $category['created'] = $this->getPaginatedResult($this->categoryService->allFileCategoriesForDataTable(), 'created_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.fileCategoriesPerPageData'));
            $category['updated'] = $this->getPaginatedResult($this->categoryService->allFileCategoriesForDataTable(), 'updated_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.fileCategoriesPerPageData'));
            $category['deleted'] = $this->getPaginatedResult($this->categoryService->allFileCategoriesForDataTable(), 'deleted_at', $this->categoryTransformer, $lastSyncDate,
                config('palika.fileCategoriesPerPageData'));
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            return response()->json([
                'code'    => 500,
                'message' => 'Error!! Please try again',
            ]);
        }
        $category['code']    = 200;
        $category['message'] = 'success';

        return $category;
    }

    /**
     * returns all the files of a category
     * @param         $id
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getAllFilesOfACategory($id, Request $request)
    {
        $lastSyncDate = $request['last_sync_date'] ? Carbon::parse($request['last_sync_date']) : '';
        try {
            $category            = $this->categoryService->getById($id);
            $response['created'] = $this->getPaginatedResult($category->uploadedFiles(), 'created_at', $this->uploadedFileTransformer, $lastSyncDate,
                config('palika.uploadedFilesPageData'));
            $response['updated'] = $this->getPaginatedResult($category->uploadedFiles(), 'updated_at', $this->uploadedFileTransformer, $lastSyncDate,
                config('palika.uploadedFilesPageData'));
            $response['deleted'] = $this->getPaginatedResult($category->uploadedFiles(), 'deleted_at', $this->uploadedFileTransformer, $lastSyncDate,
                config('palika.uploadedFilesPageData'));
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            throw $exception;
        }
        $response['code']    = 200;
        $response['message'] = 'success';

        return $response;
    }
}

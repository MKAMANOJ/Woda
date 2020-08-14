<?php

namespace App\Http\Controllers\Admin\File;

use App\Domain\Admin\Requests\File\UploadedFileRequest;
use App\Domain\Admin\Services\File\FileCategoryService;
use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Constants\FileCategories;
use App\EBP\Entities\PublicProcurement;
use App\Http\Controllers\Admin\BaseController;

class PublicProcurementController extends BaseController
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
     * @param FileCategoryService $categoryService
     * @param UploadedFileService $uploadedFileService
     */
    function __construct(FileCategoryService $categoryService, UploadedFileService $uploadedFileService)
    {

        $this->categoryService     = $categoryService;
        $this->uploadedFileService = $uploadedFileService;
    }

    public function index()
    {
//        $slug     = FileCategories::PUBLIC_PROCUREMENT_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $files        = app(PublicProcurement::class)->all();
        $categoryName = 'Public Procurement';

        return view('admin.modules.file.category.show', compact('categoryName', 'files'));
    }

    /**
     * Shows the news creation form.
     */
    public function create()
    {
//        $slug     = FileCategories::PUBLIC_PROCUREMENT_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $categoryName = 'Public Procurement';
        $route        = 'public-procurement';

        return view('admin.modules.file.file.create', compact('categoryName', 'route'));
    }

    /**
     * Stores the news in database.
     * @param UploadedFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadedFileRequest $request)
    {
//        $slug                        = FileCategories::PUBLIC_PROCUREMENT_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->store($request, 'Public Procurement');
            flash('Public Procurement Successfully Added.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('public-procurement.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryName = 'Public Procurement';
        $route        = 'public-procurement';
        $file         = $this->uploadedFileService->getById((int)$id, 'Public Procurement');

        return view('admin.modules.file.file.edit', compact('file', 'categoryName', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UploadedFileRequest                     $request
     * @param                                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadedFileRequest $request, $id)
    {
//        $slug                        = FileCategories::PUBLIC_PROCUREMENT_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->update((int)$id, $request, 'Public Procurement');
            flash('Public Procurement Successfully updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }


        return redirect()->route('public-procurement.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->uploadedFileService->destroy((int)$id, 'Public Procurement');
            flash('Public Procurement Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('public-procurement.index');
    }
}
<?php

namespace App\Http\Controllers\Admin\File;

use App\Domain\Admin\Requests\File\UploadedFileRequest;
use App\Domain\Admin\Services\File\FileCategoryService;
use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Constants\FileCategories;
use App\EBP\Entities\CitizenCharter;
use App\Http\Controllers\Admin\BaseController;

class CitizenCharterController extends BaseController
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
//        $slug     = FileCategories::CITIZEN_CHARTER_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $files        = app(CitizenCharter::class)->all();
        $categoryName = 'Citizen Charter';

        return view('admin.modules.file.category.show', compact('files', 'categoryName'));
    }

    /**
     * Shows the news creation form.
     */
    public function create()
    {
//        $slug     = FileCategories::CITIZEN_CHARTER_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $categoryName = 'Citizen Charter';
        $route        = 'citizen-charter';

        return view('admin.modules.file.file.create', compact('categoryName', 'route'));
    }

    /**
     * Stores the news in database.
     * @param UploadedFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadedFileRequest $request)
    {
//        $slug                        = FileCategories::CITIZEN_CHARTER_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->store($request, 'Citizen/Charter');
            flash('Citizen Charter Successfully Added.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to add. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('citizen-charter.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $slug     = FileCategories::CITIZEN_CHARTER_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
//        $file     = $this->uploadedFileService->getById((int)$id);
        $categoryName = 'Citizen Charter';
        $route        = 'citizen-charter';
        $file         = $this->uploadedFileService->getById((int)$id, 'Citizen/Charter');

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
//        $slug                        = FileCategories::CITIZEN_CHARTER_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->update((int)$id, $request, 'Citizen/Charter');
            flash('Citizen Charter Successfully updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }


        return redirect()->route('citizen-charter.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->uploadedFileService->destroy((int)$id, 'Citizen/Charter');
            flash('Citizen Charter Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('citizen-charter.index');
    }
}

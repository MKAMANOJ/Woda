<?php

namespace App\Http\Controllers\Admin\File;

use App\Domain\Admin\Requests\File\UploadedFileRequest;
use App\Domain\Admin\Services\File\FileCategoryService;
use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Constants\FileCategories;
use App\EBP\Entities\BudgetProgram;
use App\Http\Controllers\Admin\BaseController;

class BudgetProgramController extends BaseController
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
//        $slug     = FileCategories::BUDGET_PROGRAM_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $files        = app(BudgetProgram::class)->all();
        $categoryName = 'Budget Program';

        return view('admin.modules.file.category.show', compact('files', 'categoryName'));
    }

    /**
     * Shows the news creation form.
     */
    public function create()
    {
//        $slug     = FileCategories::BUDGET_PROGRAM_SLUG;
//        $category = $this->categoryService->getBySlug($slug);
        $categoryName = 'Budget Program';
        $route        = 'budget-program';

        return view('admin.modules.file.file.create', compact('categoryName', 'route'));
    }

    /**
     * Stores the news in database.
     * @param UploadedFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadedFileRequest $request)
    {
//        $slug                        = FileCategories::BUDGET_PROGRAM_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->store($request, 'Budget/Program');
            flash('New Budget/Program Successfully Added.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to add file.')->error();
        }

        return redirect()->route('budget-program.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryName = 'Budget/Program';
        $route        = 'budget-program';
        $file         = $this->uploadedFileService->getById((int)$id, 'Budget/Program');

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
//        $slug                        = FileCategories::BUDGET_PROGRAM_SLUG;
//        $category                    = $this->categoryService->getBySlug($slug);
//        $request['file_category_id'] = $category->id;
        try {
            $file = $this->uploadedFileService->update((int)$id, $request, 'Budget/Program');
            flash('New Budget/Program Successfully Updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }


        return redirect()->route('budget-program.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->uploadedFileService->destroy((int)$id, 'Budget/Program');
            flash('Budget Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to Delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('budget-program.index');
    }
}

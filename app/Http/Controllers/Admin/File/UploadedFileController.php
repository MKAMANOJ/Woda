<?php

namespace App\Http\Controllers\Admin\File;

use App\Domain\Admin\Requests\File\FileCategoryRequest;
use App\Domain\Admin\Requests\File\UploadedFileRequest;
use App\Domain\Admin\Services\File\FileCategoryService;
use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Entities\FileCategory;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UploadedFileController extends BaseController
{

    /**
     * @var Datatables
     */
    protected $dataTables;
    /**
     * @var FileCategoryService
     */
    protected $categoryService;
    /**
     * @var UploadedFileService
     */
    protected $fileService;

    /**
     * GalleryCategoryController constructor.
     * @param Datatables          $dataTables
     * @param FileCategoryService $categoryService
     * @param UploadedFileService $fileService
     */
    public function __construct(Datatables $dataTables, FileCategoryService $categoryService, UploadedFileService $fileService)
    {
        $this->dataTables      = $dataTables;
        $this->categoryService = $categoryService;
        $this->fileService     = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.file.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->allFileCategoriesForDataTable()->pluck('name', 'id');

        return view('admin.modules.file.file.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadedFileRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadedFileRequest $request)
    {
        try {
            $file = $this->fileService->store($request);
            flash('Successfully Added A New File.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to add file.')->error();
        }


        return redirect()->route('file.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->getById((int)$id);

        return view('admin.modules.gallery.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryService->allFileCategoriesForDataTable()->pluck('name', 'id');
        $file       = $this->fileService->getById((int)$id);

        return view('admin.modules.file.file.edit', compact('file', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FileCategoryRequest|UploadedFileRequest $request
     * @param                                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadedFileRequest $request, $id)
    {
        try {
            $file = $this->fileService->update((int)$id, $request);
            flash('Successfully updated File.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update file.')->error();
        }


        return redirect()->route('file.categories');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
                $this->fileService->destroy((int)$id);
                flash('Successfully deleted file.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete file')->error();
        }

        return redirect()->route('file.categories');
    }
}

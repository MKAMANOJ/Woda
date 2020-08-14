<?php

namespace App\Http\Controllers\Admin\File;

use App\Domain\Admin\Requests\File\FileCategoryRequest;
use App\Domain\Admin\Services\File\FileCategoryService;
use App\EBP\Entities\FileCategory;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FileCategoryController extends BaseController
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
     * GalleryCategoryController constructor.
     * @param FileCategoryService $categoryService
     * @param Datatables          $dataTables
     */
    public function __construct(FileCategoryService $categoryService, Datatables $dataTables)
    {
        $this->categoryService = $categoryService;
        $this->dataTables      = $dataTables;
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
     * Returns all the data for datatable
     */
    public function getAllCategoriesForDataTable()
    {
        $categories = $this->categoryService->allFileCategoriesForDataTable();

        return $this->dataTables->of($categories)
            ->addColumn('action', function (FileCategory $fileCategory) {
                $actionParameters = [
                    'id'   => $fileCategory->id,
                    'name' => 'file.categories',
                ];
                $otherButtons     = "<a href='".route('file.categories.show', $fileCategory->id)."' type='button'  class='btn btn-sm blue filter-submit margin-bottom'>View Files</a>";

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true, 'otherButtons' => $otherButtons]);
            })
            ->editColumn('name', function (FileCategory $fileCategory) {
                return ucwords($fileCategory->name);
            })
            ->rawColumns(['action', 'name'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.file.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileCategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileCategoryRequest $request)
    {
        $request['slug'] = str_slug($request['name']);
        try {
            $category = $this->categoryService->store($request->all());
            flash('New category Successfully Added.')->success();
        } catch (\Exception $exception) {
            logger()->info($exception->getMessage());
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
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

        return view('admin.modules.file.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->getById((int)$id);

        return view('admin.modules.file.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FileCategoryRequest $request
     * @param                     $id
     * @return \Illuminate\Http\Response
     */
    public function update(FileCategoryRequest $request, $id)
    {
        $request['slug'] = str_slug($request['name']);
        try {
            $this->categoryService->update($id, $request->all());
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->back();
        }
        flash()->success('Category Successfully updated.');

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
            $this->categoryService->destroy((int)$id);
            flash('Category Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('file.categories');
    }
}

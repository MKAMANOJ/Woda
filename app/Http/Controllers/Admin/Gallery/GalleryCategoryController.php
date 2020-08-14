<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Domain\Admin\Requests\Gallery\GalleryCategoryRequest;
use App\Domain\Admin\Services\Gallery\GalleryCategoryService;
use App\EBP\Entities\GalleryCategory;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GalleryCategoryController extends BaseController
{
    /**
     * @var GalleryCategoryService
     */
    protected $categoryService;
    /**
     * @var Datatables
     */
    protected $dataTables;

    /**
     * GalleryCategoryController constructor.
     * @param GalleryCategoryService $categoryService
     * @param Datatables             $dataTables
     */
    public function __construct(GalleryCategoryService $categoryService, Datatables $dataTables)
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
        return view('admin.modules.gallery.category.index');
    }

    public function getAllCategoriesForDataTable()
    {
        $categories = $this->categoryService->allGalleryCategoriesForDataTable();

        return $this->dataTables->of($categories)
            ->addColumn('action', function (GalleryCategory $galleryCategory) {
                $actionParameters = [
                    'id'   => $galleryCategory->id,
                    'name' => 'gallery.categories',
                ];
                $otherButtons     = "<a href='".route('gallery.categories.show', $galleryCategory->id)."' type='button'  class='btn btn-sm blue filter-submit margin-bottom'>View Photos</a>";

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true, 'otherButtons' => $otherButtons]);
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
        return view('admin.modules.gallery.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GalleryCategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->store($request->all());
            flash('Category Successfully Added.')->success();
        } catch (\Exception $exception) {
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('gallery.categories');
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
        $category = $this->categoryService->getById((int)$id);
        if (config('palika.galleryCategory')[0]['name'] == $category->name) {
            flash('You cannot edit this category.')->error();

            return redirect()->route('gallery.categories');
        }

        return view('admin.modules.gallery.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GalleryCategoryRequest|Request $request
     * @param                                $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryCategoryRequest $request, $id)
    {
        try {
            $this->categoryService->update($id, $request->all());
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->back();
        }
        flash()->success('Category Successfully updated.');

        return redirect()->route('gallery.categories');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (config('palika.galleryCategory')[0]['name'] == $this->categoryService->getById($id)->name) {
                flash('You cannot delete this category.')->error();
            } else {
                $this->categoryService->destroy((int)$id);
                flash('Category Successfully deleted.')->success();
            }
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('gallery.categories');
    }
}

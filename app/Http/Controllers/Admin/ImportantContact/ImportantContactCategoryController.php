<?php

namespace App\Http\Controllers\Admin\ImportantContact;

use App\Domain\Admin\Requests\ImportantContact\CategoryRequest;
use App\Domain\Admin\Services\ImportantContact\ImportantContactCategoryService;
use App\EBP\Entities\ImportantContact\ImportantContactCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ImportantContactCategoryController extends Controller
{
    /**
     * @var Datatables
     */
    protected $dataTables;
    /**
     * @var ImportantContactCategoryService
     */
    private $categoryService;

    /**
     * GalleryCategoryController constructor.
     * @param Datatables                      $dataTables
     * @param ImportantContactCategoryService $categoryService
     */
    public function __construct(Datatables $dataTables, ImportantContactCategoryService $categoryService)
    {
        $this->dataTables      = $dataTables;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.importantContact.category.index');
    }

    /**
     * Returns all the categories for data table.
     */
    public function getAllCategoriesForDataTable()
    {
        $categories = $this->categoryService->allGalleryCategoriesForDataTable();

        return $this->dataTables->of($categories)
            ->addColumn('action', function (ImportantContactCategory $category) {
                $actionParameters = [
                    'id'   => $category->id,
                    'name' => 'important-contact.categories',
                ];
                $otherButtons     = "<a href='".route('important-contact.categories.show', $category->id)."' type='button'  class='btn btn-sm blue filter-submit margin-bottom'>View Contacts</a>";

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true, 'otherButtons' => $otherButtons]);
            })
            ->editColumn('name', function (ImportantContactCategory $category) {
                return ucwords($category->name);
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
        return view('admin.modules.importantContact.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->store($request->all());
            flash('Category Successfully Added.')->success();
        } catch (\Exception $exception) {
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
            logger()->error($exception->getMessage());
        }

        return redirect()->route('important-contact.categories');
    }

    /**
     * Display the specified category details.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->getById((int)$id);

        return view('admin.modules.importantContact.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->getById((int)$id);

        return view('admin.modules.importantContact.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest                $request
     * @param                                $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->categoryService->update($id, $request->all());
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->back();
        }
        flash()->success('Category Successfully updated.');

        return redirect()->route('important-contact.categories');
    }

    /**
     * Remove the specified category from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (config('palika.importantContactCategory')[0]['name'] == $this->categoryService->getById($id)->name) {
                flash('This category cannot be deleted.')->error();
            } else {
                $this->categoryService->destroy((int)$id);
                flash('Category Successfully deleted.')->success();
            }
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('important-contact.categories');
    }
}

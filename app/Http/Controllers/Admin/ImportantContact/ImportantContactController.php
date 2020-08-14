<?php

namespace App\Http\Controllers\Admin\ImportantContact;

use App\Domain\Admin\Requests\ImportantContact\ContactRequest;
use App\Domain\Admin\Services\ImportantContact\ImportantContactCategoryService;
use App\Domain\Admin\Services\ImportantContact\ImportantContactService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportantContactController extends Controller
{
    /**
     * @var ImportantContactCategoryService
     */
    protected $categoryService;
    /**
     * @var ImportantContactService
     */
    private $contactService;

    /**
     * Display a listing of the resource.
     * @param ImportantContactCategoryService $categoryService
     * @param ImportantContactService         $contactService
     */
    public function __construct(ImportantContactCategoryService $categoryService, ImportantContactService $contactService)
    {
        $this->categoryService = $categoryService;
        $this->contactService  = $contactService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryId = request('category')?? null;
        $categories = $this->categoryService->allGalleryCategoriesForDataTable()->pluck('name', 'id');

        return view('admin.modules.importantContact.contact.create', compact('categories', 'categoryId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try {
            $contact = $this->contactService->store($request->all());
            logger()->info('successfully added contact.');
            flash('Contact Successfully Added.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('important-contact.categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryService->allGalleryCategoriesForDataTable()->pluck('name', 'id');
        $contact    = $this->contactService->getById((int)$id);

        return view('admin.modules.importantContact.contact.edit', compact('contact', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest|Request $request
     * @param                        $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id)
    {
        try {
            $contact = $this->contactService->update((int)$id, $request);
            logger()->info('successfully updated contact');
            flash('Contact Successfully updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified image from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->contactService->destroy((int)$id);
            flash('Contact Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->back();
    }
}

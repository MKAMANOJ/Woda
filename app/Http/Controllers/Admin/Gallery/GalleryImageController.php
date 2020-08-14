<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Domain\Admin\Requests\Gallery\GalleryImageRequest;
use App\Domain\Admin\Services\Gallery\GalleryCategoryService;
use App\Domain\Admin\Services\Gallery\GalleryImageService;
use App\EBP\Entities\GalleryCategory;
use App\EBP\Entities\GalleryImage;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Menu;
use App\Services\MenusService;
use Illuminate\Http\Request;

class GalleryImageController extends BaseController
{
    protected $categoryService;
    /**
     * @var GalleryImageService
     */
    protected $imageService;

    /**
     * Display a listing of the resource.
     *
     * @param GalleryCategoryService $categoryService
     * @param GalleryImageService    $imageService
     */
    public function __construct(GalleryCategoryService $categoryService, GalleryImageService $imageService)
    {
        $this->categoryService = $categoryService;
        $this->imageService    = $imageService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $showCategory = !request('direct-to-gallery');
        $categories   = $this->categoryService->allGalleryCategoriesForDataTable()->pluck('name', 'id');

        return view('admin.modules.gallery.image.create', compact('categories', 'showCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GalleryImageRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryImageRequest $request)
    {
        if ($request['direct-to-gallery']) {
            $request['gallery_category_id'] = app(GalleryCategory::class)
                ->where('name', config('palika.galleryCategory')[0]['name'])->first()->id;
        }
        try {
            $image = $this->imageService->store($request->all());
            logger()->info('successfully added image');
            flash('Image Successfully added.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('gallery.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GalleryImage $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryImage $galleryImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showCategory = !request('direct-to-gallery');
        $categories   = $this->categoryService->allGalleryCategoriesForDataTable()->pluck('name', 'id');
        $image        = $this->imageService->getById((int)$id);

        return view('admin.modules.gallery.image.edit', compact('image', 'categories', 'showCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GalleryImageRequest|Request $request
     * @param                             $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryImageRequest $request, $id)
    {
        if (!isset($request['gallery_category_id'])) {
            $request['gallery_category_id'] = app(GalleryCategory::class)
                ->where('name', config('palika.galleryCategory')[0]['name'])->first()->id;
        }
        try {
            $image = $this->imageService->update((int)$id, $request);
            logger()->info('Image Successfully updated.');
            flash('Successfully updated image.')->success();
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
            $this->imageService->destroy((int)$id);
            flash('Image Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->back();
    }
}

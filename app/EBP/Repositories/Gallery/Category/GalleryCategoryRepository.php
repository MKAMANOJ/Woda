<?php

namespace App\EBP\Repositories\Gallery\Category;


use App\EBP\Entities\GalleryCategory;
use App\EBP\Repositories\BaseRepository;

class GalleryCategoryRepository extends BaseRepository implements IGalleryCategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GalleryCategory::class;
    }

    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllGalleryCategoriesForDataTable()
    {
        return $this->model->select('id', 'name', 'created_at');
    }
}
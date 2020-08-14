<?php

namespace App\EBP\Repositories\ImportantContact\Category;


use App\EBP\Entities\GalleryCategory;
use App\EBP\Entities\ImportantContact\ImportantContactCategory;
use App\EBP\Repositories\BaseRepository;

class ImportantContactCategoryRepository extends BaseRepository implements IImportantContactCategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImportantContactCategory::class;
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
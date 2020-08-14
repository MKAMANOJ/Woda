<?php

namespace App\EBP\Repositories\File\Category;

use App\EBP\Entities\FileCategory;
use App\EBP\Repositories\BaseRepository;

class FileCategoryRepository extends BaseRepository implements IFileCategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FileCategory::class;
    }

    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllFileCategoriesForDataTable()
    {
        return $this->model->select('id', 'name', 'slug', 'order', 'created_at');
    }

    /**
     * Returns the specific File Category by given slug.
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

}
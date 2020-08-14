<?php

namespace App\EBP\Repositories\File\Category;


use App\EBP\Entities\FileCategory;

interface IFileCategoryRepository
{
    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllFileCategoriesForDataTable();

    /**
     * Returns the specific File Category by given slug.
     *
     * @param string $slug
     * @return FileCategory
     */
    public function findBySlug($slug);
}
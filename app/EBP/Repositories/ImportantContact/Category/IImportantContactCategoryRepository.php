<?php

namespace App\EBP\Repositories\ImportantContact\Category;


interface IImportantContactCategoryRepository
{
    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllGalleryCategoriesForDataTable();
}
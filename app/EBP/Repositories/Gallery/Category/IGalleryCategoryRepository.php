<?php

namespace App\EBP\Repositories\Gallery\Category;


interface IGalleryCategoryRepository
{
    /**
     * Returns the selected list to the datatable.
     *
     * @return mixed
     */
    public function getAllGalleryCategoriesForDataTable();
}
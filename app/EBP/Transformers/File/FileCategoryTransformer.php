<?php

namespace App\EBP\Transformers\File;

use App\EBP\Entities\FileCategory;
use League\Fractal;

class FileCategoryTransformer extends Fractal\TransformerAbstract
{
    /**
     * Transforms the array into desired type.
     * @param FileCategory $category
     * @return array
     */
    public function transform(FileCategory $category)
    {
        return [
            'id'   => (int)$category->id,
            'name' => $category->name,
        ];
    }
}
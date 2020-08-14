<?php

namespace App\EBP\Transformers;

use App\EBP\Entities\GalleryCategory;
use League\Fractal;

class GalleryCategoryTransformer extends Fractal\TransformerAbstract
{
    public function transform(GalleryCategory $category)
    {
        return [
            'id'   => (int)$category->id,
            'name' => $category->name,
        ];
    }
}
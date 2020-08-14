<?php

namespace App\EBP\Transformers;

use App\EBP\Entities\GalleryImage;
use League\Fractal;

class GalleryImageTransformer extends Fractal\TransformerAbstract
{
    public function transform(GalleryImage $image)
    {
        return [
            'id'    => (int)$image->id,
            'title' => $image->title,
            'links' => [
                [
                    'thumbnail' => asset('storage/'.getThumbnailPath($image->name)),
                    'image'       => asset('storage/'.$image->name),
                ],
            ],
        ];
    }
}
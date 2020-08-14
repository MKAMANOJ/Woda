<?php

namespace App\EBP\Repositories\Gallery\Image;


use App\EBP\Entities\GalleryImage;
use App\EBP\Repositories\BaseRepository;

class GalleryImageRepository extends BaseRepository implements IGalleryImageRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GalleryImage::class;
    }
}
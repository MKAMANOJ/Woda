<?php

namespace App\Observers;

use App\EBP\Entities\GalleryImage;

class GalleryImageObserver
{
    /**
     * @param GalleryImage $image
     */
    public function created(GalleryImage $image)
    {
        $image->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param GalleryImage $image
     */
    public function updated(GalleryImage $image)
    {
        $image->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param GalleryImage $image
     */
    public function deleted(GalleryImage $image)
    {
        $image->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
<?php

namespace App\Observers;

use App\EBP\Entities\GalleryCategory;

class GalleryCategoryObserver
{
    /**
     * @param GalleryCategory $category
     */
    public function created(GalleryCategory $category)
    {
        $category->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param GalleryCategory $category
     */
    public function updated(GalleryCategory $category)
    {
        $category->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param GalleryCategory $category
     */
    public function deleted(GalleryCategory $category)
    {
        $category->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
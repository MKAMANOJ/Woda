<?php

use App\EBP\Entities\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('palika.galleryCategory');

        foreach ($categories as $key => $category) {
            if (!app(GalleryCategory::class)->where('name', $category['name'])->exists()) {
                app(GalleryCategory::class)->create($category);
            }
        }
    }
}

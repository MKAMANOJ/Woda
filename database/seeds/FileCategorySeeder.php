<?php

use App\EBP\Entities\FileCategory;
use Illuminate\Database\Seeder;

class FileCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('fileCategories');
        foreach ($categories as $key => $category) {
            if (!app(FileCategory::class)->where('slug', $category['slug'])->exists()) {
                app(FileCategory::class)->create($category);
            }
        }
    }
}

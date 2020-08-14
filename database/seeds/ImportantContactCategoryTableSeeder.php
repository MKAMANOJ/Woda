<?php

use App\EBP\Entities\ImportantContact\ImportantContactCategory;
use Illuminate\Database\Seeder;

class ImportantContactCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('palika.importantContactCategory');

        foreach ($categories as $key => $category) {
            if (!app(ImportantContactCategory::class)->where('name', $category['name'])->exists()) {
                app(ImportantContactCategory::class)->create($category);
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(GalleryCategoryTableSeeder::class);
        $this->call(FileCategorySeeder::class);
        $this->call(ContactUsInfoSeeder::class);
        $this->call(ImportantContactCategoryTableSeeder::class);
        $this->call(IntroductionSeeder::class);
    }
}

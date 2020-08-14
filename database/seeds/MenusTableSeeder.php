<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

/**
 * Class MenusTableSeeder
 */
class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();
        $menus = config('menus');
        foreach ($menus as $menu) {
            $childrenMenus = $menu['children'];
            unset($menu['children']);
            if (!Menu::where('title', $menu['title'])->exists()) {
                $parentMenu = Menu::create($menu);
                foreach ($childrenMenus as $childrenMenu) {
                    if (!Menu::where('title', $childrenMenu['title'])->exists()) {
                        $childrenMenu['parent_id'] = $parentMenu->id;
                        Menu::create($childrenMenu);
                    }
                }
            }
        }

    }
}

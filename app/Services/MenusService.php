<?php

namespace App\Services;

use App\Models\Menu;

/**
 * Class MenusService
 * @package App\Services
 */
class MenusService
{
    /**
     * @var Menu
     */
    private $menu;

    /**
     * MenusService constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Get menus as array
     * @return array
     * @internal param int $parentId
     */
    public function getMenus()
    {
        return $this->menu->with('children')->where('parent_id', 0)->get();
    }

    /**
     * Get menus for api call
     * @return array
     * @internal param int $parentId
     */
    public function getMenusForApi()
    {
        return $this->menu->where('parent_id', 0)->select('id', 'title as title_en',
            'nepali_title as title_np')->get()->toArray();
    }
}

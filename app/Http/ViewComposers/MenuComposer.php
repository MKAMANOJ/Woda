<?php

namespace App\Http\ViewComposers;

use App\Services\MenusService;
use Illuminate\View\View;

/**
 * Class MenuComposer
 * @package App\Http\ViewComposers
 */
class MenuComposer
{
    /**
     * @var MenusService
     */
    private $menusService;

    /**
     * MenuComposer constructor.
     * @param MenusService $menusService
     */
    public function __construct(MenusService $menusService)
    {
        $this->menusService = $menusService;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('menus', $this->menusService->getMenus());
    }
}

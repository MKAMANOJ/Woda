<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MenusService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @var MenusService
     */
    protected $menusService;

    /**
     * MenuController constructor.
     * @param MenusService $menusService
     */
    function __construct(MenusService $menusService)
    {
        $this->menusService = $menusService;
    }

    /**
     * Returns all the menus for api.
     * @return string
     */
    public function index()
    {
        try {
            $menus = $this->menusService->getMenusForApi();
        } catch (\Exception $exception) {
            return response()->json([
                'code'    => 500,
                'message' => 'Error!! Please try again',
            ]);
        }

        return response()->json([
            'code'    => 200,
            'message' => 'success',
            'count'   => count($menus),
            'menus'   => $menus,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Admin\Services\UsersService;
use App\Http\Controllers\Controller;
use DaveJamesMiller\Breadcrumbs\Facade as Breadcrumbs;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends BaseController
{
    /**
     * @var Breadcrumbs
     */
    protected $breadcrumbs;
    /**
     * @var UsersService
     */
    private $usersService;

    /**
     * AdminController constructor.
     * @param Breadcrumbs      $breadcrumbs
     * @param UsersService     $usersService
     */
    public function __construct(
        Breadcrumbs $breadcrumbs,
        UsersService $usersService
    ) {
        $this->breadcrumbs      = $breadcrumbs;
        $this->usersService     = $usersService;
    }

    /**
     * Dashboard home.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $numberOfUsers     = $this->usersService->getCount();
        $breadcrumbs       = $this->breadcrumbs::render('admin.index.dashboard');
        $revenueChart      = [
            [
                "date" => "Jan 2017",
                "data" => 2025,
            ],
            [
                "date" => "Feb 2017",
                "data" => 1882,
            ],
            [
                "date" => "Mar 2017",
                "data" => 1809,
            ],
            [
                "date" => "Apr 2017",
                "data" => 1322,
            ],
            [
                "date" => "May 2017",
                "data" => 1122,
            ],
            [
                "date" => "Jun 2017",
                "data" => 1114,
            ],
            [
                "date" => "Jul 2017",
                "data" => 984,
            ],
            [
                "date" => "Aug 2017",
                "data" => 711,
            ],
            [
                "date" => "Sep 2017",
                "data" => 665,
            ],
            [
                "date" => "Oct 2017",
                "data" => 580,
            ],
            [
                "date" => "Nov 2017",
                "data" => 443,
            ],
            [
                "date" => "Dec 2017",
                "data" => 441,
            ],
        ];
        $capacityChart     = [
            [
                "title" => "Pallets Free",
                "value" => 20,
            ],
            [
                "title" => "Pallets Filled",
                "value" => 80,
            ],
        ];

        return view('admin.index',
            compact('breadcrumbs', 'numberOfUsers', 'numberOfWareHouse', 'revenueChart', 'capacityChart', 'users'));
    }
}

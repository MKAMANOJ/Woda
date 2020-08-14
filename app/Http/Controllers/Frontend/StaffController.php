<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\Staff;

class StaffController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $staffs = app(Staff::class)->orderBy('order')->get();

        return view('frontend.staff', compact('staffs'));
    }
}
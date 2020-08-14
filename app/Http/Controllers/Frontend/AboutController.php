<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\Introduction;

class AboutController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $introduction = app(Introduction::class)->first();

        return view('frontend.about', compact('introduction'));
    }
}
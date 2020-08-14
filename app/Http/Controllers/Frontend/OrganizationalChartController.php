<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\GalleryImage;

class OrganizationalChartController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $orgChart = app(GalleryImage::class)->where('title', 'Organizational Chart')->first();

        return view('frontend.organizational_chart', compact('orgChart'));
    }
}
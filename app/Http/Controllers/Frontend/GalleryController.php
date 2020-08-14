<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\GalleryCategory;
use App\EBP\Entities\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $galleries = app(GalleryCategory::class)
                    ->where('name', '!=', 'Miscellaneous')
                    ->where('name', '!=', 'Slides')
                    ->get();

        return view('frontend.gallery', compact('galleries'));
    }

    public function show($id)
    {
        App::setLocale(session()->get('checkLanguages'));
        $gallery = app(GalleryCategory::class)
                    ->where('name', '!=', 'Miscellaneous')
                    ->where('name', '!=', 'Slides')
                    ->findorfail($id);

        return view('frontend.images', compact('gallery'));
    }
}
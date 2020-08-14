<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\Home;
use App\EBP\Entities\Staff;
use App\EBP\Entities\WasteBusRoutine;
use App\EBP\Entities\News;
use App\EBP\Entities\GalleryCategory;

class HomeController extends Controller
{
    public function index()
    {
        if(session()->has('checkLanguages')){
            if(session()->get('checkLanguages') == 'np') {
                App::setLocale('np');
                session()->put('checkLanguages', 'np');            
            } else {
                App::setLocale('en');
                session()->put('checkLanguages', 'en');                           
            }
        }

        $staffs = app(Staff::class)->orderBy('order')->take(2)->get();
        $wasteBusRoutine = app(WasteBusRoutine::class)->first();
        $news = app(News::class)->latest()->take(5)->get();
        $slides = app(GalleryCategory::class)->where('name', 'Slides')->first()->images;
        $home = app(Home::class)->first();

        return view('frontend.home', compact('home', 'staffs', 'wasteBusRoutine', 'slides'));
    }

    public function english()
    {
        App::setLocale('en');
        session()->put('checkLanguages', 'en');

        return redirect()->back();
    }

    public function nepali()
    {
        App::setLocale('np');
        session()->put('checkLanguages', 'np');

        return redirect()->back();
    }

    public function about()
    {
        App::setLocale(session()->get('checkLanguages'));

        return view('frontend.about');
    }
}
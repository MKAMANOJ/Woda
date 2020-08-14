<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\Download;

class DownloadController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $downloads = app(Download::class)->get();

        return view('frontend.download', compact('downloads'));
    }
}
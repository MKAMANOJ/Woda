<?php

namespace App\Http\Controllers\Admin\Home;

use App\Domain\Admin\Requests\Home\HomeRequest;
use App\EBP\Entities\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $home      = app(Home::class)->first();
        $homeType  = 'Home';
        $route     = 'home';

        return view('admin.modules.home.edit', compact('home', 'homeType', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HomeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(HomeRequest $request)
    {
        try {
        	$home = app(Home::class)->first();
        	if (!$home)  {
        		app(Home::class)->create($request->all());
        	} else {
	            $home->update($request->all());
        	}
            flash('Home Successfully Updated.')->success();
        } catch (\Exception $exception) {
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
            logger()->info($exception->getMessage());
        }

        return redirect()->back();
    }
}

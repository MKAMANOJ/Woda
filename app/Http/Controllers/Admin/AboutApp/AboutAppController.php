<?php

namespace App\Http\Controllers\Admin\AboutApp;

use App\Domain\Admin\Requests\Introduction\IntroductionRequest;
use App\EBP\Entities\AboutApp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutAppController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $introduction     = app(AboutApp::class)->findOrFail(2);
        $introductionType = 'About App Info';
        $route            = 'about-app';

        return view('admin.modules.introduction.edit', compact('introduction', 'introductionType', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IntroductionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(IntroductionRequest $request)
    {
        try {
            app(AboutApp::class)->findOrFail(2)->update($request->all());
            flash('About App Info Successfully Updated.')->success();
        } catch (\Exception $exception) {
            flash('Unable to update About App Info.')->error();
            logger()->info($exception->getMessage());
        }

        return redirect()->back();
    }
}

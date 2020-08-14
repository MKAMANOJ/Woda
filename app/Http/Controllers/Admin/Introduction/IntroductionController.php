<?php

namespace App\Http\Controllers\Admin\Introduction;

use App\Domain\Admin\Requests\Introduction\IntroductionRequest;
use App\EBP\Entities\Introduction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntroductionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $introduction     = app(Introduction::class)->first();
        $introductionType = 'Introduction';
        $route            = 'introduction';

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
            $introduction = app(Introduction::class)->first();
            if (!$introduction)  {
                app(Introduction::class)->create($request->all());
            } else {
                $introduction->update($request->all());
            }
            flash('Introduction Successfully Updated.')->success();
        } catch (\Exception $exception) {
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
            logger()->info($exception->getMessage());
        }

        return redirect()->back();
    }
}

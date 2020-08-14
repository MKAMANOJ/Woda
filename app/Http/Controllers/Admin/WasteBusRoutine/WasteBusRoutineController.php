<?php

namespace App\Http\Controllers\Admin\WasteBusRoutine;

use App\Domain\Admin\Requests\WasteBusRoutine\WasteBusRoutineRequest;
use App\EBP\Entities\WasteBusRoutine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WasteBusRoutineController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $wasteBusRoutine      = app(WasteBusRoutine::class)->first();
        $wasteBusRoutineType  = 'WasteBusRoutine';
        $route                = 'wasteBusRoutine';

        return view('admin.modules.wasteBusRoutine.edit', compact('wasteBusRoutine', 'wasteBusRoutineType', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WasteBusRoutineRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(WasteBusRoutineRequest $request)
    {
        try {
        	$wasteBusRoutine = app(WasteBusRoutine::class)->first();
        	if (!$wasteBusRoutine)  {
        		app(WasteBusRoutine::class)->create($request->all());
        	} else {
	            $wasteBusRoutine->update($request->all());
        	}
            flash('Waste Bus Routine Successfully Updated.')->success();
        } catch (\Exception $exception) {
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
            logger()->info($exception->getMessage());
        }

        return redirect()->back();
    }
}

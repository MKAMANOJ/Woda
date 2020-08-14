<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Domain\Admin\Requests\Staff\StaffRequest;
use App\Domain\Admin\Services\Staff\StaffService;
use App\EBP\Entities\Staff;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * @var StaffService
     */
    protected $staffService;
    /**
     * @var Datatables
     */
    private $dataTables;

    /**
     * @param StaffService $staffService
     * @param Datatables   $dataTables
     */
    function __construct(StaffService $staffService, Datatables $dataTables)
    {
        $this->staffService = $staffService;
        $this->dataTables   = $dataTables;
    }

    /**
     * Display a listing of the staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.staff.index');
    }

    /**
     * Returns All Staffs For DataTable
     * @param Request $request
     */
    public function getAllForDataTable(Request $request)
    {
        $staffs = $this->staffService->getAllForDataTable();

        return $this->dataTables->of($staffs)
            ->addColumn('action', function (Staff $staff) {
                $actionParameters = [
                    'id'   => $staff->id,
                    'name' => 'staff',
                ];

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true]);
            })
            ->editColumn('name', function (Staff $staff) {
                return ucwords($staff->name);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StaffRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        try {
            $staff = $this->staffService->store($request->all());
        } catch (\Exception $exception) {
            logger()->error($exception);
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->route('staff.index');
        }
        flash('Staff Successfully Added.')->success();

        return redirect()->route('staff.index');
    }

    /**
     * Display the specified staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified staff.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = $this->staffService->getById((int)$id);

        return view('admin.modules.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff in storage.
     *
     * @param StaffRequest|Request $request
     * @param                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        try {
            $staff = $this->staffService->update((int)$id, $request->all());
            logger()->info('successfully updated Staff');
            flash('Staff Successfully Updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified staff from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->staffService->destroy((int)$id);
            flash('Staff Successfully Deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('staff.index');
    }
}

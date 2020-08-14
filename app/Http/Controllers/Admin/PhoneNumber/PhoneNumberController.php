<?php

namespace App\Http\Controllers\Admin\PhoneNumber;

use App\Domain\Admin\Requests\PhoneNumber\PhoneNumberRequest;
use App\Domain\Admin\Services\PhoneNumber\PhoneNumberService;
use App\EBP\Entities\PhoneNumber;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    /**
     * @var PhoneNumberService
     */
    protected $phoneNumberService;
    /**
     * @var Datatables
     */
    private $dataTables;

    /**
     * @param PhoneNumberService $phoneNumberService
     * @param Datatables   $dataTables
     */
    function __construct(PhoneNumberService $phoneNumberService, Datatables $dataTables)
    {
        $this->phoneNumberService = $phoneNumberService;
        $this->dataTables   = $dataTables;
    }

    /**
     * Display a listing of the phone number.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.phoneNumber.index');
    }

    /**
     * Returns All Phone Numbers For DataTable
     * @param Request $request
     */
    public function getAllForDataTable(Request $request)
    {
        $phoneNumbers = $this->phoneNumberService->getAllForDataTable();

        return $this->dataTables->of($phoneNumbers)
            ->addColumn('action', function (PhoneNumber $phoneNumber) {
                $actionParameters = [
                    'id'   => $phoneNumber->id,
                    'name' => 'phone-numbers',
                ];

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true]);
            })
            ->editColumn('name', function (PhoneNumber $phoneNumber) {
                return ucwords($phoneNumber->name);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new phone number.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.phoneNumber.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PhoneNumberRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneNumberRequest $request)
    {
        try {
            $phoneNumber = $this->phoneNumberService->store($request->all());
        } catch (\Exception $exception) {
            logger()->error($exception);
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->route('phone-numbers.index');
        }
        flash('Phone Number Successfully Added.')->success();

        return redirect()->route('phone-numbers.index');
    }

    /**
     * Show the form for editing the specified phone number.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phoneNumber = $this->phoneNumberService->getById((int)$id);

        return view('admin.modules.phoneNumber.edit', compact('phoneNumber'));
    }

    /**
     * Update the specified phoneNumber in storage.
     *
     * @param PhoneNumberRequest|Request $request
     * @param                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneNumberRequest $request, $id)
    {
        try {
            $phoneNumber = $this->phoneNumberService->update((int)$id, $request->all());
            logger()->info('Successfully updated PhoneNumber');
            flash('PhoneNumber Successfully Updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('phone-numbers.index');
    }

    /**
     * Remove the specified phoneNumber from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->phoneNumberService->destroy((int)$id);
            flash('Phone Number Successfully Deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('phone-numbers.index');
    }
}

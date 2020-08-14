<?php

namespace App\Http\Controllers\Admin\WebsiteLink;

use App\Domain\Admin\Requests\WebsiteLink\WebsiteLinkRequest;
use App\Domain\Admin\Services\WebsiteLink\WebsiteLinkService;
use App\EBP\Entities\WebsiteLink;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class WebsiteLinkController extends Controller
{
    /**
     * @var WebsiteLinkService
     */
    protected $websiteLinkService;
    /**
     * @var Datatables
     */
    private $dataTables;

    /**
     * @param WebsiteLinkService $websiteLinkService
     * @param Datatables   $dataTables
     */
    function __construct(WebsiteLinkService $websiteLinkService, Datatables $dataTables)
    {
        $this->websiteLinkService = $websiteLinkService;
        $this->dataTables   = $dataTables;
    }

    /**
     * Display a listing of the website link.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modules.websiteLink.index');
    }

    /**
     * Returns All Website Links For DataTable
     * @param Request $request
     */
    public function getAllForDataTable(Request $request)
    {
        $websiteLinks = $this->websiteLinkService->getAllForDataTable();

        return $this->dataTables->of($websiteLinks)
            ->addColumn('action', function (WebsiteLink $websiteLink) {
                $actionParameters = [
                    'id'   => $websiteLink->id,
                    'name' => 'website-links',
                ];

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['info' => true]);
            })
            ->editColumn('name', function (WebsiteLink $websiteLink) {
                return ucwords($websiteLink->name);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new website link.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.websiteLink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WebsiteLinkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebsiteLinkRequest $request)
    {
        try {
            $websiteLink = $this->websiteLinkService->store($request->all());
        } catch (\Exception $exception) {
            logger()->error($exception);
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();

            return redirect()->route('website-links.index');
        }
        flash('website link Successfully Added.')->success();

        return redirect()->route('website-links.index');
    }

    /**
     * Show the form for editing the specified website link.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $websiteLink = $this->websiteLinkService->getById((int)$id);

        return view('admin.modules.websiteLink.edit', compact('websiteLink'));
    }

    /**
     * Update the specified website link in storage.
     *
     * @param WebsiteLinkRequest|Request $request
     * @param                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteLinkRequest $request, $id)
    {
        try {
            $websiteLink = $this->websiteLinkService->update((int)$id, $request->all());
            logger()->info('Successfully updated Website link');
            flash('Website Link Successfully Updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('website-links.index');
    }

    /**
     * Remove the specified websiteLink from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->websiteLinkService->destroy((int)$id);
            flash('website link Successfully Deleted.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect()->route('website-links.index');
    }
}

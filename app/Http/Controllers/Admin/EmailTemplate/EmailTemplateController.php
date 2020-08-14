<?php

namespace App\Http\Controllers\Admin\EmailTemplate;

use App\Domain\Admin\Requests\EmailTemplates\EmailTemplateRequest;
use App\Domain\Admin\Services\EmailTemplates\EmailTemplatesService;
use App\EBP\Entities\EmailTemplate\EmailTemplate;
use App\Http\Controllers\Admin\BaseController;
use DaveJamesMiller\Breadcrumbs\Facade as Breadcrumbs;
use Yajra\Datatables\Datatables;

/**
 * Class EmailTemplateController
 * @package App\Http\Controllers\Admin\EmailTemplate
 */
class EmailTemplateController extends BaseController
{
    /**
     * @var EmailTemplatesService
     */
    private $emailTemplateService;

    /**
     * @var Breadcrumbs
     */
    private $breadcrumbs;
    /**
     * @var Datatables
     */
    private $datatables;

    /**
     * EmailTemplateController constructor.
     * @param EmailTemplatesService $emailTemplateService
     * @param Breadcrumbs           $breadcrumbs
     * @param Datatables            $datatables
     */
    public function __construct(
        EmailTemplatesService $emailTemplateService,
        Breadcrumbs $breadcrumbs,
        Datatables $datatables
    ) {
        $this->emailTemplateService = $emailTemplateService;
        $this->breadcrumbs          = $breadcrumbs;
        $this->datatables           = $datatables;
    }

    /**
     * Display a listing of the email template.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $breadcrumbs = $this->breadcrumbs::render('email-template.index');

        return view('admin.modules.emailTemplates.index', compact('breadcrumbs'));
    }

    /**
     *Show the form for creating a new email template.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $breadcrumbs = $this->breadcrumbs::render('email-template.create');

        return view('admin.modules.emailTemplates.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created email template in storage.
     *
     * @param EmailTemplateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmailTemplateRequest $request)
    {
        try {
            $this->emailTemplateService->store($request->all());
        } catch (\Exception $exception) {
            logger()->error($exception);
            flash()->error('Unable to add new Email Template.');

            return redirect()->back();
        }
        flash()->success('Successfully added new Email Template.');

        return redirect()->route('email-template.index');
    }

    /**
     * Show the form for editing the specified email template.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $emailTemplate = $this->emailTemplateService->getById((int)$id);
        $breadcrumbs   = $this->breadcrumbs::render('email-template.edit', $emailTemplate);

        return view('admin.modules.emailTemplates.edit', compact('emailTemplate', 'breadcrumbs'));
    }

    /**
     * Update the specified email template in storage.
     *
     * @param int                  $id
     * @param EmailTemplateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, EmailTemplateRequest $request)
    {
        try {
            $request->offsetUnset('slug');
            $this->emailTemplateService->updateEmailTemplate($id, $request->all());
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash()->error('Unable to update the Email Template.');

            return redirect()->back();
        }
        flash()->success('Successfully updated the Email Template.');

        return redirect()->route('email-template.index');
    }

    /**
     * Displays the particular email template.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $emailTemplate = $this->emailTemplateService->getById((int)$id);
        $breadcrumbs   = $this->breadcrumbs::render('email-template.show', $emailTemplate);

        return view('admin.modules.emailTemplates.show', compact('emailTemplate', 'breadcrumbs'));
    }

    /**
     * Returns all the email templates for dataTable on ajax call.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getEmailTemplateForDataTable()
    {
        $emailTemplates = $this->emailTemplateService->allEmailTemplateForDataTable();

        return $this->datatables->of($emailTemplates)
            ->editColumn('created_at', function (EmailTemplate $emailTemplate) {
                return $emailTemplate->formatted_created_at;
            })
            ->addColumn('action', function (EmailTemplate $emailTemplate) {
                $actionParameters = [
                    'id'   => $emailTemplate->id,
                    'name' => 'email-template',
                ];

                return view('admin.datatable.index', compact('actionParameters'))
                    ->with(['exceptDelete' => true, 'info' => true]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}

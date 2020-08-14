<?php

namespace App\Http\Controllers\Admin\ContactUsInfo;

use App\Domain\Admin\Requests\ContactUsInfo\ContactUsInfoRequest;
use App\Domain\Admin\Services\ContactUsInfo\ContactUsInfoService;
use App\EBP\Repositories\ContactUsInfo\IContactUsInfoRepository;
use App\Http\Controllers\Controller;

class ContactUsInfoController extends Controller
{
    /**
     * @var IContactUsInfoRepository
     */
    protected $contactUsInfoService;

    /**
     * @param ContactUsInfoService $contactUsInfoService
     */
    function __construct(ContactUsInfoService $contactUsInfoService)
    {
        $this->contactUsInfoService = $contactUsInfoService;
    }

    /**
     * Shows the edit page of contact us info.
     */
    public function edit()
    {
        $contactUsInfo = $this->contactUsInfoService->getContactInfoDetail();

        return view('admin.modules.contactUsInfo.edit', compact('contactUsInfo'));
    }

    /**
     * Updates the contact us info details.
     * @param ContactUsInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactUsInfoRequest $request)
    {
        try {
            $info = $this->contactUsInfoService->updateContactUsInfo($request->all());
            flash('Contact Us Info Successfully Updated.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Unable to Update Contact Us Info.')->error();
        }

        return redirect()->back();
    }
}

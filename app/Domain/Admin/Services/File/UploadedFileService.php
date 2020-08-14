<?php

namespace App\Domain\Admin\Services\File;

use App\Domain\Admin\Services\FCM\PushNotificationService;
use App\EBP\Entities\BudgetProgram;
use App\EBP\Entities\CitizenCharter;
use App\EBP\Entities\Download;
use App\EBP\Entities\LawRegulation;
use App\EBP\Entities\News;
use App\EBP\Entities\PlanningProject;
use App\EBP\Entities\PublicProcurement;
use App\EBP\Entities\TaxFee;
use App\EBP\Entities\UploadedFile;
use App\EBP\Entities\WardProfile;
use App\EBP\Entities\Report;
use App\EBP\Repositories\File\File\IUploadedFileRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class UploadedFileService
{
    /**
     * @var IUploadedFileRepository
     */
    private $fileRepository;
    /**
     * @var FileCategoryService
     */
    protected $categoryService;
    /**
     * @var PushNotificationService
     */
    protected $pushNotificationService;

    protected $model;

    /**
     * UploadedFileService constructor.
     * @param IUploadedFileRepository $fileRepository
     * @param FileCategoryService     $categoryService
     * @param PushNotificationService $pushNotificationService
     */
    public function __construct(IUploadedFileRepository $fileRepository, FileCategoryService $categoryService,
                                PushNotificationService $pushNotificationService)
    {
        $this->fileRepository          = $fileRepository;
        $this->categoryService         = $categoryService;
        $this->pushNotificationService = $pushNotificationService;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param Request $request
     * @param string  $fileType
     * @return
     * @throws \Exception
     */
    public function store(Request $request, string $fileType)
    {
        switch ($fileType) {
            case 'News':
                $this->model = new News();
                $categoryId  = 1;
                break;
            case 'Budget/Program':
                $this->model = new BudgetProgram();
                $categoryId  = 6;
                break;
            case 'Citizen/Charter':
                $this->model = new CitizenCharter();
                $categoryId  = 2;
                break;
            case 'Download':
                $this->model = new Download();
                $categoryId  = 3;
                break;
            case 'Project/Planning':
                $this->model = new PlanningProject();
                $categoryId  = 5;
                break;
            case 'Public Procurement':
                $this->model = new PublicProcurement();
                $categoryId  = 4;
                break;
            case 'Tax/Fee':
                $this->model = new TaxFee();
                $categoryId  = 7;
                break;
            case 'Ward Profile':
                $this->model = new WardProfile();
                $categoryId  = 9;
                break;
            case 'Regulation/Law':
                $this->model = new LawRegulation();
                $categoryId  = 9;
                break;
            case 'Report':
                $this->model = new Report();
                $categoryId  = 10;
                break;
        }
        try {
//            $categoryName = $this->categoryService->getById($request['file_category_id'])->name;
            if ($request->hasFile('uploaded_file')) {
                $request['original_filename'] = $request['uploaded_file']->getClientOriginalName();
                $fileExtension                = strtolower($request['uploaded_file']->getClientOriginalExtension());
                $request['content_type']      = ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png')
                    ? 'image' : ($fileExtension == 'pdf' ? 'pdf' : '');
                $request['file_name']         = uploadDocument($request['uploaded_file'], str_slug($fileType));
            } else if ($request['content']) {
                $request['content_type'] = 'html';
            }
            $file          = $this->model->create($request->all());
            $file->content = 'content';
            if (isset($request['sendNotification'])) {
                $this->pushNotificationService->sendPushNotificationByTopic([
                    'title'            => $file->title.' (New '.$fileType.' )',
                    'text'             => $file->description,
                    'key'              => $file->id,
                    'file_category_id' => $categoryId,
                    'content'          => $file,
                ]);
            }

            return $file;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int    $id
     * @param string $fileType
     * @return UploadedFile
     */
    public function getById(int $id, string $fileType)
    {
        switch ($fileType) {
            case 'News':
                $this->model = new News();
                break;
            case 'Budget/Program':
                $this->model = new BudgetProgram();
                break;
            case 'Citizen/Charter':
                $this->model = new CitizenCharter();
                break;
            case 'Download':
                $this->model = new Download();
                break;
            case 'Project/Planning':
                $this->model = new PlanningProject();
                break;
            case 'Public Procurement':
                $this->model = new PublicProcurement();
                break;
            case 'Tax/Fee':
                $this->model = new TaxFee();
                break;
            case 'Ward Profile':
                $this->model = new WardProfile();
                break;
            case 'Regulation/Law':
                $this->model = new LawRegulation();
                break;
            case 'Report':
                $this->model = new Report();
        }

        return $this->model->findOrFail($id);
    }

    /**
     * Updates the Email Template of given id.
     * @param int     $id
     * @param Request $request
     * @param string  $fileType
     * @return UploadedFile
     * @throws \Exception
     */
    public function update(int $id, Request $request, string $fileType)
    {
        switch ($fileType) {
            case 'News':
                $this->model = new News();
                $categoryId  = 1;
                break;
            case 'Budget/Program':
                $this->model = new BudgetProgram();
                $categoryId  = 6;
                break;
            case 'Citizen/Charter':
                $this->model = new CitizenCharter();
                $categoryId  = 2;
                break;
            case 'Download':
                $this->model = new Download();
                $categoryId  = 3;
                break;
            case 'Project/Planning':
                $this->model = new PlanningProject();
                $categoryId  = 5;
                break;
            case 'Public Procurement':
                $this->model = new PublicProcurement();
                $categoryId  = 4;
                break;
            case 'Tax/Fee':
                $this->model = new TaxFee();
                $categoryId  = 7;
                break;
            case 'Ward Profile':
                $this->model = new WardProfile();
                $categoryId  = 9;
                break;
            case 'Regulation/Law':
                $this->model = new LawRegulation();
                $categoryId  = 8;
                break;
            case 'Report':
                $this->model = new Report();
                $categoryId  = 9;
                break;
        }
        try {
            $file = $this->getById($id, $fileType);
//            $categoryName = $this->categoryService->getById($request['file_category_id'])->name;
            if ($request->hasFile('uploaded_file')) {
                $request['content']           = null;
                $request['original_filename'] = $request['uploaded_file']->getClientOriginalName();
                $fileExtension                = strtolower($request['uploaded_file']->getClientOriginalExtension());
                $request['content_type']      = ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png')
                    ? 'image' : ($fileExtension == 'pdf' ? 'pdf' : '');
                $request['file_name']         = $file->file_name ? updateDocument($file->file_name, $request['uploaded_file'],
                    str_slug($fileType)) : uploadDocument($request['uploaded_file'], str_slug($fileType));
            } else if ($request['content']) {
                $request['content_type']      = 'html';
                $request['original_filename'] = null;
                $request['file_name']         = null;
            }

            $file          = $file->update($request->all());
            $file          = $this->getById($id, $fileType);
            $file->content = 'content';
            if (isset($request['sendNotification'])) {
                $this->pushNotificationService->sendPushNotificationByTopic([
                    'title'            => $file->title.' (Updated)',
                    'text'             => $file->description,
                    'key'              => $file->id,
                    'file_category_id' => $categoryId,
                    'content'          => $file,
                ]);
            }

            return $file;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int    $id
     * @param string $fileType
     * @return bool
     */
    public function destroy(int $id, string $fileType)
    {
        $file = $this->getById($id, $fileType);
        delete($file->file_name, false);

        return $file->delete();
    }
}

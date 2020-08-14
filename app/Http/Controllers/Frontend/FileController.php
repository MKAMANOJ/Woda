<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\TaxFee;
use App\EBP\Entities\LawRegulation;
use App\EBP\Entities\BudgetProgram;
use App\EBP\Entities\PlanningProject;
use App\EBP\Entities\Report;
use App\EBP\Entities\PublicProcurement;
use App\EBP\Entities\News;

class FileController extends Controller
{
    public function index($fileSlug)
    {
        App::setLocale(session()->get('checkLanguages'));
        switch ($fileSlug) {
            case 'tax-fee':
                $files = $this->getFileModel(TaxFee::class);
                break;
            case 'law-regulation':
                $files = $this->getFileModel(LawRegulation::class);
                break;
            case 'budget-program':
                $files = $this->getFileModel(BudgetProgram::class);
                break;
            case 'plan-project':
                $files = $this->getFileModel(PlanningProject::class);
                break;
            case 'report':
                $files = $this->getFileModel(Report::class);
                break;
            case 'public-procurement':
                $files = $this->getFileModel(PublicProcurement::class);
                break;
            case 'notice-information':
                $files = app(News::class)->where('id', '>', 5)->orderBy('order')->get();
                break;
            default :
                abort(404);
        }

        return view('frontend.file', compact('files', 'fileSlug'));
    }

    private function getFileModel($fileModel)
    {
        return app($fileModel)->orderBy('order')->get();
    }

    public function show($fileSlug, $id)
    {
        App::setLocale(session()->get('checkLanguages'));
        switch ($fileSlug) {
            case 'tax-fee':
                $file = $this->getFileModelDetail(TaxFee::class, $id);
                break;
            case 'law-regulation':
                $file = $this->getFileModelDetail(LawRegulation::class, $id);
                break;
            case 'budget-program':
                $file = $this->getFileModelDetail(BudgetProgram::class, $id);
                break;
            case 'budget-program':
                $file = $this->getFileModelDetail(PlanningProject::class, $id);
                break;
            case 'report':
                $file = $this->getFileModelDetail(Report::class, $id);
                break;
            case 'public-procurement':
                $file = $this->getFileModelDetail(PublicProcurement::class, $id);
                break;
            case 'notice-information':
                $file = $this->getFileModelDetail(News::class, $id);
                break;
            default :
                abort(404);
        }

        return view('frontend.file_detail', compact('file'));
    }

    private function getFileModelDetail($fileModelDetail, $fileModelId)
    {
        return app($fileModelDetail)->findorfail($fileModelId);
    }
}
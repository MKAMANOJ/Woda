<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\EBP\Entities\ContactUsInfo;
use App\EBP\Entities\PhoneNumber;
use App\EBP\Entities\WebsiteLink;
use App\EBP\Entities\News;
/**
 * Class FrontFooterComposer
 * @package App\Http\ViewComposers
 */
class FrontendComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $contactUs = app(ContactUsInfo::class)->first();
        $phoneNumbers = app(PhoneNumber::class)->orderBy('order')->get() ?? '';
        $websiteLinks = app(WebsiteLink::class)->orderBy('order')->get() ?? '';
        $news = app(News::class)->where('id', '<=', 5)->orderBy('order')->get();

        $view->with(compact('contactUs', 'phoneNumbers', 'websiteLinks', 'news'));
    }
}

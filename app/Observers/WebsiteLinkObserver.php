<?php

namespace App\Observers;


use App\EBP\Entities\WebsiteLink;

class WebsiteLinkObserver
{
    /**
     * @param WebsiteLink $websiteLink
     */
    public function created(WebsiteLink $websiteLink)
    {
        $websiteLink->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param WebsiteLink $websiteLink
     */
    public function updated(WebsiteLink $websiteLink)
    {
        $websiteLink->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param WebsiteLink $websiteLink
     */
    public function deleted(WebsiteLink $websiteLink)
    {
        $websiteLink->histories()->create([
            'body' => 'deleted',
        ]);
    }
}
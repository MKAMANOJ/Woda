<?php

namespace App\Observers;

use App\EBP\Entities\Download;

class DownloadObserver
{
    /**
     * @param Download $download
     */
    public function created(Download $download)
    {
        $download->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param Download $download
     */
    public function updated(Download $download)
    {
        $download->histories()->create([
            'body' => 'updated',
        ]);
    }

    /**
     * @param Download $download
     */
    public function deleted(Download $download)
    {
        $download->histories()->create([
            'body' => 'deleted',
        ]);
    }
}

<?php

namespace App\Observers;

use App\EBP\Entities\News;

class NewsObserver
{
    /**
     * @param News $news
     */
    public function created(News $news)
    {
        $news->histories()->create([
            'body' => 'created',
        ]);
    }

    /**
     * @param News $news
     */
    public function updated(News $news)
    {
        $news->histories()->create([
            'body' => 'updated',
        ]);
    }

    public function deleted(News $news)
    {
        $news->histories()->create([
            'body' => 'deleted',
        ]);
    }
}

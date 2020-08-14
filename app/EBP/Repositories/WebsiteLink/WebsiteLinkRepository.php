<?php

namespace App\EBP\Repositories\WebsiteLink;

use App\EBP\Entities\WebsiteLink;
use App\EBP\Repositories\BaseRepository;
use App\EBP\Repositories\WebsiteLink\IWebsiteLinkRepository;

class WebsiteLinkRepository extends BaseRepository implements IWebsiteLinkRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WebsiteLink::class;
    }

    /**
     * Return all the website links.
     * @param bool $dataTable
     * @return mixed
     */
    public function getAll($dataTable = false)
    {
        $query = $this->model->select('id', 'name', 'website_link', 'order');
        if ($dataTable) {
            return $query;
        } else {
            return $query->get();
        }
    }
}

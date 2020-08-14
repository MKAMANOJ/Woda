<?php

namespace App\EBP\Repositories\WebsiteLink;


interface IWebsiteLinkRepository
{
    /**
     * Return all the staffs.
     * @param bool $dataTable
     * @return
     */
    public function getAll($dataTable = false);
}
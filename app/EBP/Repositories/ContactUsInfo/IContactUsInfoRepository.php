<?php

namespace App\EBP\Repositories\ContactUsInfo;


interface IContactUsInfoRepository
{
    /**
     * Returns the details of contact information.
     */
    public function getInfo();

    /**
     * Updates the contact info.
     * @param $updateData
     * @return
     */
    public function updateInfo($updateData);
}
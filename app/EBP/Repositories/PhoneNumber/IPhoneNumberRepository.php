<?php

namespace App\EBP\Repositories\PhoneNumber;


interface IPhoneNumberRepository
{
    /**
     * Return all the staffs.
     * @param bool $dataTable
     * @return
     */
    public function getAll($dataTable = false);
}
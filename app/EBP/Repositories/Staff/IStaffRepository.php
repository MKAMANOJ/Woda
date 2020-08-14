<?php

namespace App\EBP\Repositories\Staff;


interface IStaffRepository
{
    /**
     * Return all the staffs.
     * @param bool $dataTable
     * @return
     */
    public function getAll($dataTable = false);
}
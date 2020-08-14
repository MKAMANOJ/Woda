<?php

namespace App\EBP\Repositories\Staff;

use App\EBP\Entities\Staff;
use App\EBP\Repositories\BaseRepository;
use App\EBP\Repositories\Staff\IStaffRepository;

class StaffRepository extends BaseRepository implements IStaffRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Staff::class;
    }

    /**
     * Return all the staffs.
     * @param bool $dataTable
     * @return mixed
     */
    public function getAll($dataTable = false)
    {
        $query = $this->model->select('id', 'name', 'email', 'designation', 'personal_phone');
        if ($dataTable) {
            return $query;
        } else {
            return $query->get();
        }
    }
}

<?php

namespace App\EBP\Repositories\PhoneNumber;

use App\EBP\Entities\PhoneNumber;
use App\EBP\Repositories\BaseRepository;
use App\EBP\Repositories\PhoneNumber\IPhoneNumberRepository;

class PhoneNumberRepository extends BaseRepository implements IPhoneNumberRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PhoneNumber::class;
    }

    /**
     * Return all the phone numbers.
     * @param bool $dataTable
     * @return mixed
     */
    public function getAll($dataTable = false)
    {
        $query = $this->model->select('id', 'name', 'phone_number', 'order');
        if ($dataTable) {
            return $query;
        } else {
            return $query->get();
        }
    }
}

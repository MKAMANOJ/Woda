<?php

namespace App\EBP\Repositories\ContactUsInfo;


use App\EBP\Entities\ContactUsInfo;
use App\EBP\Repositories\BaseRepository;

class ContactUsInfoRepository extends BaseRepository implements IContactUsInfoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactUsInfo::class;
    }

    /**
     * Returns the details of contact information.
     */
    public function getInfo()
    {
        return $this->model->first();
    }

    /**
     * Updates the contact info.
     * @param $updateData
     * @return bool
     */
    public function updateInfo($updateData)
    {
        $info = $this->getInfo();
        if (!$info)  {
            return $this->model->create($updateData);
        } else {
            return $info->update($updateData);
        }
    }
}
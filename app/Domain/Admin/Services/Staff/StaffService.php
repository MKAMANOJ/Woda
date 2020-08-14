<?php

namespace App\Domain\Admin\Services\Staff;

use App\EBP\Entities\Staff;
use App\EBP\Repositories\Staff\IStaffRepository;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class StaffService
{
    /**
     * @var IStaffRepository
     */
    protected $staffRepository;

    /**
     * GalleryImageService constructor.
     * @param IStaffRepository $staffRepository
     */
    public function __construct(IStaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return Staff
     */
    public function store(array $inputData): Staff
    {
        if (isset($inputData['image'])) {
            $inputData['image'] = upload($inputData['image'], 'staff');
        }

        return $this->staffRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return Staff
     * @throws \Exception
     */
    public function getById(int $id): Staff
    {
        return $this->staffRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return Staff
     */
    public function update(int $id, array $updateData): Staff
    {
        if (isset($updateData['image'])) {
            $updateData['image'] = upload($updateData['image'], 'staff');
        }

        return $this->staffRepository->update($updateData, $id);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->staffRepository->delete($id);
    }

    /**
     * Returns All Staffs For DataTable
     */
    public function getAllForDataTable()
    {
        return $this->staffRepository->getAll($dataTable = true);
    }
}

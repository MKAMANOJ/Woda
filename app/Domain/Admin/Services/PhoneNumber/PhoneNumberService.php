<?php

namespace App\Domain\Admin\Services\PhoneNumber;

use App\EBP\Entities\PhoneNumber;
use App\EBP\Repositories\PhoneNumber\PhoneNumberRepository;
use Illuminate\Http\Request;


/**
 * Class EmailTemplatesService
 * @package App\Domain\Admin\Services\EmailTemplates
 */
class PhoneNumberService
{
    /**
     * @var IPhoneNumberRepository
     */
    protected $phoneNumberRepository;

    /**
     * GalleryImageService constructor.
     * @param IPhoneNumberRepository $phoneNumberRepository
     */
    public function __construct(PhoneNumberRepository $phoneNumberRepository)
    {
        $this->phoneNumberRepository = $phoneNumberRepository;
    }

    /**
     *  Store a newly created Email Template in the storage.
     *
     * @param array $inputData
     * @return PhoneNumber
     */
    public function store(array $inputData): PhoneNumber
    {
        return $this->phoneNumberRepository->create($inputData);
    }

    /**
     * Returns the specific Email Template by given id.
     *
     * @param int $id
     * @return PhoneNumber
     * @throws \Exception
     */
    public function getById(int $id): PhoneNumber
    {
        return $this->phoneNumberRepository->find($id);
    }

    /**
     * Updates the Email Template of given id.
     *
     * @param int   $id
     * @param array $updateData
     * @return PhoneNumber
     */
    public function update(int $id, array $updateData): PhoneNumber
    {
        return $this->phoneNumberRepository->update($updateData, $id);
    }

    /**
     * Remove the specified image from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->phoneNumberRepository->delete($id);
    }

    /**
     * Returns All Staffs For DataTable
     */
    public function getAllForDataTable()
    {
        return $this->phoneNumberRepository->getAll($dataTable = true);
    }
}

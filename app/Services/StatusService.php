<?php

namespace App\Services;

use App\EBP\Repositories\Status\IStatusRepository;

/**
 * Class StatusServices
 * Class AwsImageService
 * @package App\Services
 */
class StatusService
{
    /**
     * @var IStatusRepository
     */
    private $statusRepository;

    /**
     * StatusService constructor.
     * @param IStatusRepository $statusRepository
     */
    public function __construct(IStatusRepository $statusRepository)
    {

        $this->statusRepository = $statusRepository;
    }

    /**
     * @param string $statusFor
     * @param string $slug
     * @return mixed
     */
    public function getStatus(string $statusFor, string $slug)
    {
        return $this->statusRepository->getStatus($statusFor, $slug);
    }

    /**
     * Returns the status by its id.
     * @param int $id
     * @return mixed
     */
    public function getStatusById(int $id)
    {
        return $this->statusRepository->find($id);
    }
}

<?php

namespace App\Domain\Front\Policies;

use App\Domain\Front\Services\ScheduleMovement\ScheduleMovementService;
use App\EBP\Constants\General;
use App\EBP\Constants\StatusFlag;
use App\EBP\Entities\Quotation\Quotation;
use App\EBP\Entities\ScheduleMovement\ScheduleMovement;
use App\EBP\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ScheduleMovementPolicy
 * @package App\Policies
 */
class ScheduleMovementPolicy
{
    use HandlesAuthorization;
    /**
     * @var ScheduleMovementService
     */
    private $scheduleMovementService;

    /**
     * ScheduleMovementPolicy constructor.
     * @param ScheduleMovementService $scheduleMovementService
     */
    public function __construct(ScheduleMovementService $scheduleMovementService)
    {
        $this->scheduleMovementService = $scheduleMovementService;
    }

    /**
     * Policy for edit scheduleMovement
     * @param User             $user
     * @param ScheduleMovement $scheduleMovement
     * @return bool
     */
    public function edit(User $user, ScheduleMovement $scheduleMovement): bool
    {
        if (!$this->isMyScheduleMovement($user, $scheduleMovement)) {
            return false;
        }
        if ($this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::NEW) ||
            $this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::REVISION_FOR_REVIEW_FILLER) ||
            $this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::REVISION_FOR_REVIEW_FINDER)
        ) {
            return true;
        }

        return false;
    }

    /**
     * Policy for can approve or not schedule Movement
     * @param User             $user
     * @param ScheduleMovement $scheduleMovement
     * @return bool
     */
    public function approve(User $user, ScheduleMovement $scheduleMovement): bool
    {
        if (!$this->isMyScheduleMovement($user, $scheduleMovement)) {
            return false;
        }
        if ($this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::NEW)) {
            return $this->isFiller($user) ? true : false;
        } elseif ($this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::REVISION_FOR_REVIEW_FILLER)
        ) {
            return $this->isFinder($user) ? true : false;
        } elseif ($this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::REVISION_FOR_REVIEW_FINDER)
        ) {
            return $this->isFiller($user) ? true : false;
        }

        return false;
    }

    /**
     * Policy for can approve or not schedule Movement
     * @param User             $user
     * @param ScheduleMovement $scheduleMovement
     * @return bool
     */
    public function decline(User $user, ScheduleMovement $scheduleMovement): bool
    {
        if (!$this->isMyScheduleMovement($user, $scheduleMovement)) {
            return false;
        }
        if ($this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::NEW)) {
            return $this->isFiller($user) ? true : false;
        } elseif ($this->scheduleMovementService->checkStatus($scheduleMovement,
            StatusFlag::REVISION_FOR_REVIEW_FILLER)
        ) {
            return $this->isFinder($user) ? true : false;
        } elseif ($this->scheduleMovementService->checkStatus($scheduleMovement,
            StatusFlag::REVISION_FOR_REVIEW_FINDER)
        ) {
            return $this->isFiller($user) ? true : false;
        }

        return false;
    }

    /**
     * @param User             $user
     * @param ScheduleMovement $scheduleMovement
     * @return bool
     */
    public function receive(User $user, ScheduleMovement $scheduleMovement): bool
    {
        if (!$this->scheduleMovementService->checkStatus($scheduleMovement, StatusFlag::APPROVED)) {
            return false;
        }
        if ($scheduleMovement->type == StatusFlag::SCHEDULE_IN) {
            return $this->isFiller($user) ?? false;
        } elseif ($scheduleMovement->type == StatusFlag::SCHEDULE_OUT) {
            return $this->isFinder($user) ?? false;
        }
    }

    /**
     * Return user is filler or not
     * @param User $user
     * @return bool
     */
    private function isFiller(User $user): bool
    {
        return ($user->roles->first()->name == General::FILLER);
    }

    /**
     * Return User is finder or not
     * @param User $user
     * @return bool
     */
    private function isFinder(User $user): bool
    {
        return (($user->roles->first()->name == General::FINDER));
    }

    /**
     * Return schedule and user is associate or not
     * @param User             $user
     * @param ScheduleMovement $scheduleMovement
     * @return bool
     */
    private function isMyScheduleMovement(User $user, ScheduleMovement $scheduleMovement): bool
    {
        if ($this->isFiller($user)) {
            return (bool)$user->id == $scheduleMovement->quotation->supplier->user->id;
        } else {
            return (bool)$user->id == $scheduleMovement->quotation->created_by;
        }
    }
}

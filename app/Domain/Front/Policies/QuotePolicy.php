<?php

namespace App\Domain\Front\Policies;

use App\EBP\Constants\StatusFlag;
use App\EBP\Entities\Quotation\Quotation;
use App\EBP\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class QuotePolicy
 * @package App\Domain\Front\Policies
 */
class QuotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if a quote detail can be viewed by the user
     * @param User      $user
     * @param Quotation $quote
     * @return bool
     */
    public function show(User $user, Quotation $quote): bool
    {
        return ($user->id == $quote->supplier->user->id || $user->id == $quote->created_by);
    }

    /**
     * Check if the user can edit the quote or not, its based upon whether its approved / disapproved too.
     * @param User      $user
     * @param Quotation $quote
     * @return bool
     */
    public function edit(User $user, Quotation $quote): bool
    {
        $isOwner            = ($user->id == $quote->supplier->user->id || $user->id == $quote->created_by);
        $approvedOrDeclined = ($quote->status->slug == StatusFlag::APPROVED) || ($quote->status->slug == StatusFlag::DECLINED);

        return ($isOwner && !$approvedOrDeclined);
    }

    /**
     * Policy for schedule movement creation
     * @param User      $user
     * @param Quotation $quote
     * @return bool
     */
    public function createScheduleMovement(User $user, Quotation $quote)
    {
        return ($user->id == $quote->created_by);
    }
}

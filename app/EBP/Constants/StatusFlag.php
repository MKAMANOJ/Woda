<?php

namespace App\EBP\Constants;

/**
 * Class StatusFlag
 * @package App\EBP\Constants
 */
class StatusFlag
{
    const UNVERIFIED                  = 'unverified';
    const VERIFIED                    = 'verified';
    const DEACTIVATED                 = 'deactivated';
    const DELETED                     = 'deleted';
    const DRAFT                       = 'draft';
    const PUBLISHED                   = 'published';
    const UNPUBLISHED                 = 'unpublished';
    const SUBMITTED                   = 'submitted';
    const ACKNOWLEDGED                = 'acknowledged';
    const RESPONDED                   = 'responded';
    const NEW                         = 'new';
    const APPROVED                    = 'approved';
    const DECLINED                    = 'declined';
    const EXPIRED                     = 'expired';
    const ON_REVIEW                   = 'on review';
    const ACTIVE                      = 'active';
    const INACTIVE                    = 'inactive';
    const REVISION_FOR_REVIEW_FILLER  = 'revision-for-review-filler';
    const REVISION_FOR_REVIEW_FINDER  = 'revision-for-review-finder';
    const COMPLETED                   = 'completed';
    const SCHEDULE_IN                 = 'in';
    const SCHEDULE_OUT                = 'out';
    const PAYMENT_ERROR               = 'payment error';
    const REMOVED                     = 'removed';
    const AWAITING_SCHEDULED_MOVEMENT = 'Awaiting scheduled movement';
    const INVOICE_INITIAL             = 'initial';
    const INVOICE_WEEKLY              = 'weekly';
}

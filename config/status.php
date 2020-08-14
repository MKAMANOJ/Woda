<?php

use App\EBP\Constants\General;
use App\EBP\Constants\StatusFlag;

return [
    [
        'status_for' => General::QUOTATION,
        'name'       => StatusFlag::NEW,
        'slug'       => str_slug(StatusFlag::NEW),
        'comment'    => 'Quotation is submitted / pending',
    ],
    [
        'status_for' => General::QUOTATION,
        'name'       => StatusFlag::APPROVED,
        'slug'       => str_slug(StatusFlag::APPROVED),
        'comment'    => 'Quotation is approved.',
    ],
    [
        'status_for' => General::QUOTATION,
        'name'       => StatusFlag::DECLINED,
        'slug'       => str_slug(StatusFlag::DECLINED),
        'comment'    => 'Quotation is declined.',
    ],
    [
        'status_for' => General::QUOTATION,
        'name'       => StatusFlag::EXPIRED,
        'slug'       => str_slug(StatusFlag::EXPIRED),
        'comment'    => 'Quotation is expired.',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::NEW,
        'slug'       => str_slug(StatusFlag::NEW),
        'comment'    => 'Schedule is submitted / pending',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::APPROVED,
        'slug'       => str_slug(StatusFlag::APPROVED),
        'comment'    => 'Schedule is approved.',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::DECLINED,
        'slug'       => str_slug(StatusFlag::DECLINED),
        'comment'    => 'Schedule is declined.',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::DECLINED,
        'slug'       => str_slug(StatusFlag::DECLINED),
        'comment'    => 'Schedule is declined.',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::REVISION_FOR_REVIEW_FILLER,
        'slug'       => str_slug(StatusFlag::REVISION_FOR_REVIEW_FILLER),
        'comment'    => 'Waiting for filler response',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::REVISION_FOR_REVIEW_FINDER,
        'slug'       => str_slug(StatusFlag::REVISION_FOR_REVIEW_FINDER),
        'comment'    => 'Waiting for finder response',
    ],
    [
        'status_for' => General::SCHEDULE,
        'name'       => StatusFlag::COMPLETED,
        'slug'       => str_slug(StatusFlag::COMPLETED),
        'comment'    => 'Completed',
    ],
    [
        'status_for' => 'user-detail',
        'name'       => StatusFlag::ACTIVE,
        'slug'       => str_slug(StatusFlag::ACTIVE),
        'comment'    => 'Active',
    ],
    [
        'status_for' => 'user-detail',
        'name'       => StatusFlag::INACTIVE,
        'slug'       => str_slug(StatusFlag::INACTIVE),
        'comment'    => 'Inactive',
    ],
    [
        'status_for' => 'user-detail',
        'name'       => StatusFlag::PAYMENT_ERROR,
        'slug'       => str_slug(StatusFlag::PAYMENT_ERROR),
        'comment'    => 'payment error',
    ],
    [
        'status_for' => 'user-detail',
        'name'       => StatusFlag::REMOVED,
        'slug'       => str_slug(StatusFlag::REMOVED),
        'comment'    => 'removed',
    ],
];

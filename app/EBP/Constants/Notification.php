<?php

namespace App\EBP\Constants;

/**
 * Class NotificationType
 * @package App\EBP\Constants
 */
class Notification
{
    const QUOTE    = 'quote';
    const PAYMENT  = 'payment';
    const MOVEMENT = 'movements';
    const TYPES    = [self::PAYMENT, self::QUOTE, self::MOVEMENT];
    const PER_PAGE = 4;

    const QUOTE_FINDER_CREATED_TEXT       = 'Your quote to Warehouse #@warehouseId has been sent.';
    const QUOTE_FILLER_CREATED_TEXT       = 'You have received a quote from Client #@clientId.';
    const QUOTE_FINDER_UPDATE_STATUS_TEXT = 'Your quote to Warehouse #@warehouseId @warehouseName has been @status.';
    const QUOTE_FILLER_UPDATE_STATUS_TEXT = 'Your quote from Client #@clientId has been @status.';
    const QUOTE_FINDER_UPDATED_TEXT       = 'Your quote to Warehouse #@warehouseId has been revised.';
    const QUOTE_FILLER_UPDATED_TEXT       = 'Your quote from Client #@clientId has been revised.';

    const SCHEDULE_MOVEMENT_CREATED_FINDER_TEXT       = 'Your schedule movement with Warehouse #@warehouseId has been sent.';
    const SCHEDULE_MOVEMENT_CREATED_FILLER_TEXT       = 'You have received a schedule movement from Client #@clientId.';
    const SCHEDULE_MOVEMENT_FINDER_UPDATED_TEXT       = 'Your @movementType service with @warehouseName has been revised. Please review it.';
    const SCHEDULE_MOVEMENT_FILLER_UPDATED_TEXT       = 'Your @movementType service with Client #@clientId has been revised. Please review it.';
    const SCHEDULE_MOVEMENT_FINDER_UPDATE_STATUS_TEXT = 'Your @movementType service with @warehouseName has been @status.';
    const SCHEDULE_MOVEMENT_FILLER_UPDATE_STATUS_TEXT = 'Your @movementType service with Client #@clientId has been @status.';
}

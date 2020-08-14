<?php

namespace App\EBP\Constants;

/**
 * Class General
 * @package App\EBP\Constants
 */
class General
{
    const PAGINATE_SMALL  = 10;
    const PAGINATE_MEDIUM = 15;
    const PAGINATE_LARGE  = 25;
    const PAGINATE_CUSTOM = 5;

    const FORMAT_VIEW_DATE = 'jS F, Y';

    const PATH_PROFILE_IMAGE           = 'uploads/profile';
    const PATH_BLOG_HERO_IMAGE         = 'uploads/blog';
    const PATH_DOCUMENT_FILE           = '%s/uploads/documents';
    const PATH_FEEDS_FILE              = '%s/uploads/feeds/%s';
    const PATH_SCHEDULE_MOVEMENT_FILES = 'schedule_movement';

    const QUOTATION = 'quotation';
    const SCHEDULE  = 'schedule';

    const ADMIN  = 'admin';
    const FINDER = 'finder';
    const FILLER = 'filler';

    const UNAUTHORIZED_ACCESS = 'unauthorized_access';
    const UNDESIRED_ACTION    = 'undesired_action';
    const GEO_DISTANCE_UNIT   = 111.045;
    const RADIUS_UNIT         = 100;

    /**
     * @return string
     */
    public static function UPLOAD_ROOT(): string
    {
        return public_path();
    }
}

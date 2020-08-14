<?php

namespace App\EBP\Accessors\EmailTemplate;

use App\EBP\Constants\General;

/**
 * Class EmailTemplateAccessor
 * @package App\EBP\Accessors\EmailTemplate
 */
trait EmailTemplateAccessor
{
    /**
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        /** @var EmailTemplate $this */
        return $this->created_at->format(General::FORMAT_VIEW_DATE);
    }
}

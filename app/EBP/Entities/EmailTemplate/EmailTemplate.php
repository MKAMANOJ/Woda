<?php

namespace App\EBP\Entities\EmailTemplate;

use App\EBP\Accessors\EmailTemplate\EmailTemplateAccessor;
use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate
 * @package App\EBP\Entities\EmailTemplate
 */
class EmailTemplate extends Model
{
    use EmailTemplateAccessor;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::EMAIL_TEMPLATES;

    /**
     * List of the fields.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'subject',
        'content',
        'created_at',
        'updated_at',
    ];
}

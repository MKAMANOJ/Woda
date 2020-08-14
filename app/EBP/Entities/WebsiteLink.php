<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class WebsiteLink extends Model
{
    use SyncsWithFirebase;
    use SoftDeletes;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::WEBSITE_LINK;

    protected $fillable = [
        'name',
        'nepali_name',
        'website_link',
        'order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

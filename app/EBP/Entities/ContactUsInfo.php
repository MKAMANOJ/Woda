<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class ContactUsInfo extends Model
{
    use SyncsWithFirebase;

    protected $table = DBTable::CONTACT_US_INFO;

    protected $fillable = [
        'phone1',
        'phone2',
        'fax',
        'nepali_phone1',
        'nepali_phone2',
        'nepali_fax',
        'email',
        'facebook',
        'twitter',
        'google_plus',
        'map_embedded_link'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

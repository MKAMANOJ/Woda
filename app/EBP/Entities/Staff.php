<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class Staff extends Model
{
    use SoftDeletes;
    use SyncsWithFirebase;

    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::STAFF;

    protected $fillable = [
        'name',
        'nepali_name',
        'designation',
        'address',
        'email',
        'personal_phone',
        'office_phone',
        'appointment_date',
        'order',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

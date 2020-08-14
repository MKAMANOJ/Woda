<?php

namespace App\EBP\Entities\ImportantContact;

use App\EBP\Constants\DBTable;
use App\EBP\Entities\History;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class ImportantContactCategory extends Model
{
    use SoftDeletes;
    use SyncsWithFirebase;

    protected $table = DBTable::IMPORTANT_CONTACT_CATEGORY;

    protected $fillable = [
        'name',
    ];

    /**
     * A category has many contacts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function importantContacts()
    {
        return $this->hasMany(ImportantContact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

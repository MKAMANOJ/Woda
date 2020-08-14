<?php

namespace App\EBP\Entities\ImportantContact;

use App\EBP\Constants\DBTable;
use App\EBP\Entities\History;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class ImportantContact extends Model
{
    use SyncsWithFirebase;

    protected $table = DBTable::IMPORTANT_CONTACTS;

    protected $fillable = [
        'name',
        'np_name',
        'important_contact_category_id',
        'address',
        'phone',
        'fax',
        'email',
        'designation',
        'mobile',
        'service',
        'image',
    ];

    /**
     * A contact belongs to a category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function importantContactCategory()
    {
        return $this->belongsTo(ImportantContactCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

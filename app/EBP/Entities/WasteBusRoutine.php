<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class WasteBusRoutine extends Model
{
    use SyncsWithFirebase;

    protected $table    = DBTable::WASTE_BUS_ROUTINE;
    protected $fillable = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

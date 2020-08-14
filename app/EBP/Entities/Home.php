<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Home extends Model
{
    use SyncsWithFirebase;

    protected $table    = DBTable::HOME;
    protected $fillable = ['content', 'flash_message'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

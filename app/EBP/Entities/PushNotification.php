<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class PushNotification extends Model
{
    use SyncsWithFirebase;

    protected $table = DBTable::PUSH_NOTIFICATION;

    protected $fillable = ['title', 'description', 'message'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

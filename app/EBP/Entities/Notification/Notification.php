<?php

namespace App\EBP\Entities\Notification;

use App\EBP\Constants\DBTable;
use App\EBP\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Notification
 * @package App\EBP\Entities
 */
class Notification extends Model
{
    use Notifiable;
    /**
     * @var string
     */
    protected $table = DBTable::NOTIFICATIONS;
    /**
     * @var array
     */
    protected $fillable = ['is_read', 'user_id', 'type', 'notification_text', 'link', 'status'];

    /**
     * filter for logged in users
     *
     * @param $query
     * @return mixed
     */
    public function scopeOfLoggedInUser($query)
    {
        return $query->where('user_id', currentNonAdminUser()->id);
    }

    /**
     * notification belongs to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

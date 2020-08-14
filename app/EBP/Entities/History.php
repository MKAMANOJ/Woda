<?php

namespace App\EBP\Entities;

use App\EBP\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class History
 * @package App\Entities
 */
class History extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['body', 'message'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            if($user){
                $model->user_id = $user->id;
            } else {
                $model->user_id = 1;
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function history()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

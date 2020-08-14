<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App
 */
class UserStatus extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_status';

    /**
     * @var array
     */
    protected $fillable = ['name'];
}

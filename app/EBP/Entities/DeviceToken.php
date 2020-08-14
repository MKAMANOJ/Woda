<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $table    = DBTable::DEVICE_TOKEN;
    protected $fillable = ['app_name', 'token'];
}

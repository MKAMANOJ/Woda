<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * @package App\Models
 */
class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = ["parent_id", "title", "nepali_title", "text", "class", "icon", "route", "is_active", "order"];

    /**
     * Menu has many childes menu
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    /**
     * Menu may belongs to parent menu
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parents()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}

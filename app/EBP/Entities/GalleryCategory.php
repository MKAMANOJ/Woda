<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class GalleryCategory extends Model
{
    use SoftDeletes;
    use SyncsWithFirebase;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::GALLERY_CATEGORY;

    protected $fillable = [
        'name',
    ];

    /**
     * A category has many images
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

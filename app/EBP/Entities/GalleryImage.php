<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class GalleryImage extends Model
{
    use SoftDeletes;
    use SyncsWithFirebase;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::GALLERY_IMAGE;

    protected $fillable = [
        'title',
        'name',
        'description',
        'gallery_category_id',
        'original_filename',
    ];

    /**
     * An image belongs to a category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(History::class, 'history');
    }
}

<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class UploadedFile extends Model
{
    use SyncsWithFirebase;
    use SoftDeletes;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::UPLOADED_FILES;

    protected $fillable = [
        'title',
        'file_name',
        'file_category_id',
        'original_filename',
        'order',
        'content',
        'content_type',
        'description',
    ];

    /**
     * A category has many images
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fileCategory()
    {
        return $this->belongsTo(FileCategory::class);
    }
}

<?php

namespace App\EBP\Entities;

use App\EBP\Constants\DBTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Firebase\SyncsWithFirebase;

class FileCategory extends Model
{
    use SyncsWithFirebase;
    use SoftDeletes;
    /**
     * Specifies the custom table name.
     *
     * @var string
     */
    protected $table = DBTable::FILE_CATEGORY;

    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    /**
     * An image belongs to a category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uploadedFiles()
    {
        return $this->hasMany(UploadedFile::class);
    }
}

<?php

namespace App\EBP\Repositories\File\File;

use App\EBP\Entities\UploadedFile;
use App\EBP\Repositories\BaseRepository;

class UploadedFileRepository extends BaseRepository implements IUploadedFileRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UploadedFile::class;
    }
}

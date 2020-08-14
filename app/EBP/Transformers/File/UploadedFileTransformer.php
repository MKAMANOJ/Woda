<?php

namespace App\EBP\Transformers\File;

use App\EBP\Entities\UploadedFile;
use League\Fractal;

class UploadedFileTransformer extends Fractal\TransformerAbstract
{
    /**
     * Transforms the data as required by API.
     * @param UploadedFile $file
     * @return array
     */
    public function transform(UploadedFile $file)
    {
        return [
            'id'           => (int)$file->id,
            'title'        => $file->title,
            'order'        => $file->order,
            'content_type' => $file->content_type,
            'description'  => $file->description,
            'url'          => asset(getStorageURL($file->file_name)),
        ];
    }
}
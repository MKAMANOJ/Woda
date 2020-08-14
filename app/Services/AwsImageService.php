<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Psr\Log\LoggerInterface;

/**
 * Class to handle image functionality for AWS S3 bucket
 * Class AwsImageService
 * @package App\Services
 */
class AwsImageService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AwsImageService constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Upload files on AWS S3 bucket
     * @param        $image
     * @param string $folder            Specify folder if available
     * @param bool   $generateThumbnail Is thumbnail required?
     * @param string $fileVisibility    Set visibility for added file as public or private
     * @return bool|string
     */
    public function upload($image, string $folder = null, bool $generateThumbnail = true, $fileVisibility = 'public')
    {
        try {
            $imageBaseName     = uniqid('img_').'.'.$image->getClientOriginalExtension();
            $originalImage     = Image::make($image)->stream();
            $originalImageName = $folder ? "{$folder}/{$imageBaseName}" : $imageBaseName;
            if ($generateThumbnail) {
                $thumbnailImage     = Image::make($image)->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
                $thumbnailImageName = $folder ? "{$folder}/thumbnails/{$imageBaseName}" : "thumbnails/{$imageBaseName}";
                Storage::disk('s3')->put($thumbnailImageName, $thumbnailImage->__toString(), $fileVisibility);
            }
            $saveSuccess = Storage::disk('s3')->put($originalImageName, $originalImage->__toString(), $fileVisibility);
            if ($saveSuccess === true)
                return $originalImageName;
            $this->logger->error('Unable to save image to S3 bucket');
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Unable to save image to S3 bucket: %s', $exception->getMessage()));
        }

        return false;
    }

    /**
     * Get complete storage location for AWS asset
     * @param string $filePath
     * @return mixed
     */
    public function getStorageURL(string $filePath = null)
    {
        if ($filePath && Storage::disk('s3')->exists($filePath))
            return Storage::disk('s3')->url($filePath);

        return asset('admin/images/default.png');
    }

    /**
     * Get Storage location/URL for AWS thumbnail image
     * @param string $filePath
     * @return mixed
     */
    public function getStorageURLThumbnail(string $filePath = null)
    {
        if ($filePath && Storage::disk('s3')->exists($this->getThumbnailPath($filePath)))
            return $this->getStorageURL($this->getThumbnailPath($filePath));

        return asset('admin/images/default.png');
    }

    /**
     * Get Image thumbnail path
     * @param string $filePath
     * @return array|string
     */
    public function getThumbnailPath(string $filePath)
    {
        $filePath = explode('/', $filePath);
        array_splice($filePath, count($filePath) - 1, 0, ['thumbnails']);
        $filePath = implode('/', $filePath);

        return $filePath;
    }


    /**
     * Delete Image from AWS bucket
     * @param string|array $imagePath    Existing path of image from AWS
     * @param bool         $hasThumbnail if provided image has thumbnail also
     * @return bool
     */
    public function delete($imagePath, $hasThumbnail = true)
    {
        try {
            if ($hasThumbnail) {
                if (is_array($imagePath)) {
                    $thumbnailImagePath = array_map(function ($image) {
                        return $this->getThumbnailPath($image);
                    }, $imagePath);
                } else {
                    $thumbnailImagePath = $this->getThumbnailPath($imagePath);
                }
                Storage::disk('s3')->delete($thumbnailImagePath);
            }
            $deleted = Storage::disk('s3')->delete($imagePath);
            if ($deleted == true)
                return true;
            $this->logger->error(sprintf('Unable to delete AWS image with path: %s', json_encode($imagePath)));
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Unable to delete image with path: %s', json_encode($imagePath)));
        }

        return false;
    }

    /**
     * Update existing image for AWS
     * @param string      $oldImagePath
     * @param             $newImage
     * @param string|null $folder            Folder if available
     * @param bool        $generateThumbnail Is thumbnail required?
     * @param string      $fileVisibility    Set visibility of file as public or private
     * @return bool|string
     */
    public function update(string $oldImagePath = null, $newImage, string $folder = null, bool $generateThumbnail = true, $fileVisibility = 'public')
    {
        try {
            if ($oldImagePath) {
                $this->delete($oldImagePath);
            }

            return $this->upload($newImage, $folder, $generateThumbnail, $fileVisibility);
        } catch (\Exception $exception) {
            $this->logger->error(sprintf('Unable to update AWS image: %s', $exception->getMessage()));
        }

        return true;
    }

    /**
     * Upload Document
     *
     * @param $document
     * @param string|null $folder
     * @param string $fileVisibility
     */
    public function uploadDocument(UploadedFile $document, string $folder = null, string $fileVisibility = 'public')
    {
        return Storage::disk('s3')->put($folder, $document, $fileVisibility);
    }

    /**
     * Update document
     *
     * @param string $oldImagePath
     * @param UploadedFile $document
     * @param string|null $folder
     * @param string $fileVisibility
     * @return mixed
     */
    public function updateDocument(string $oldImagePath, UploadedFile $document, string $folder = null, string $fileVisibility = 'public')
    {
        $this->delete($oldImagePath);

        return Storage::disk('s3')->put($folder, $document, $fileVisibility);
    }
}

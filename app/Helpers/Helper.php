<?php

use App\EBP\Constants\DBTable;
use App\EBP\Constants\General;
use App\EBP\Constants\StatusFlag;
use App\EBP\Constants\UserRole;use App\Services\StatusService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Get thumbnail image for insert update .
 * @param string $image
 * @param string $path
 * @return string
 */
function getThumbnailImageForInsertUpdate($image = '', $path = '')
{
    return (!$image) ? asset('admin/images/default.png') :
        asset(sprintf('uploads/%s/thumbnails/%s', $path, $image));
}

/**     * Get Image thumbnail path
 * @param string $filePath
 * @return array|string
 */
function getThumbnailPath(string $filePath)
{
    $filePath = explode('/', $filePath);
    array_splice($filePath, count($filePath) - 1, 1, ['thumbnails', 'tmb_'.$filePath[count($filePath) - 1]]);
    $filePath = implode('/', $filePath);

    return $filePath;
}

function getImage($image = '', $path = '')
{
    return (!$image) ? asset('admin/images/default.png') :
        asset(sprintf('uploads/%s/thumbnails/%s', $path, $image));
}

/**
 * Upload images
 * @param        $image
 * @param string $folder            Specify folder if available
 * @param bool   $generateThumbnail Is thumbnail required?
 * @param string $fileVisibility    Set visibility for added file as public or private
 * @return bool|string
 */
function upload($image, string $folder = null, bool $generateThumbnail = true, $fileVisibility = 'public')
{
    try {
        $imageBaseName     = uniqid('img_').'.'.$image->getClientOriginalExtension();
        $originalImage     = Image::make($image)->stream();
        $originalImageName = $folder ? "{$folder}/{$imageBaseName}" : $imageBaseName;
        if ($generateThumbnail) {
            $thumbnailImage     = Image::make($image)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            $thumbnailImageName = $folder ? "{$folder}/thumbnails/tmb_{$imageBaseName}" : "thumbnails/tmb_{$imageBaseName}";
            Storage::disk('local')->put($thumbnailImageName, $thumbnailImage->__toString(), $fileVisibility);
        }
        $saveSuccess = Storage::disk('local')->put($originalImageName, $originalImage->__toString(), $fileVisibility);
        if ($saveSuccess === true)
            return $originalImageName;
        $this->logger->error('Unable to save image to S3 bucket');
    } catch (\Exception $exception) {
        $this->logger->error(sprintf('Unable to save image to S3 bucket: %s', $exception->getMessage()));
    }

    return false;
}

/**
 * Upload Document
 *
 * @param             $document
 * @param string|null $folder
 * @param string      $fileVisibility
 * @return bool|string
 */
function uploadDocument(UploadedFile $document, string $folder = null, string $fileVisibility = 'public')
{
    return Storage::disk('local')->put($folder, $document, $fileVisibility);
}

/**
 * Update document
 *
 * @param string       $oldImagePath
 * @param UploadedFile $document
 * @param string|null  $folder
 * @param string       $fileVisibility
 * @return bool|string
 */
function updateDocument(string $oldImagePath, UploadedFile $document, string $folder = null, string $fileVisibility = 'public')
{
    $path = Storage::disk('local')->put($folder, $document, $fileVisibility);
    delete($oldImagePath, false);

    return $path;
}

/**
 * Get complete storage location for AWS asset
 * @param string $filePath
 * @return mixed
 */
function getStorageURL(string $filePath = null)
{
    if (!$filePath) {
        return asset('admin/images/default.png');
    }

    return Storage::disk('local')->url($filePath);
}

/**
 * Delete file
 * @param string|array $imagePath    Existing path of image from AWS
 * @param bool         $hasThumbnail if provided image has thumbnail also
 * @return bool
 */
function delete($imagePath, $hasThumbnail = true)
{
    try {
        if ($imagePath != null) {
            if ($hasThumbnail) {
                if (is_array($imagePath)) {
                    $thumbnailImagePath = array_map(function ($image) {
                        return $this->getThumbnailPath($image);
                    }, $imagePath);
                } else {
                    $thumbnailImagePath = $this->getThumbnailPath($imagePath);
                }
                Storage::disk('local')->delete($thumbnailImagePath);
            }
            $deleted = Storage::disk('local')->delete($imagePath);
            if ($deleted == true) {
                return true;
            }
            logger()->error(sprintf('Unable to delete file with path: %s', json_encode($imagePath)));
        }
    } catch (\Exception $exception) {
        logger()->error(sprintf('Unable to delete file with path: %s', json_encode($imagePath)));
    }

    return false;
}

/**
 * Returns the admin user roles with id and display name for form.
 * @param bool $returnArray
 * @return static
 * @internal param bool $array
 */
function getAdminUserRoles($returnArray = false)
{
    $adminRoles = collect(config('userroles'))->slice(0, 1)->pluck('display_name', 'id');
    if (!$returnArray) {
        return $adminRoles;
    }

    return $adminRoles->toArray();
}

/**
 * Returns the client user roles with id and display name for them.
 * @param bool $selectAllOption
 * @return static
 */
function getClientUserRoles($selectAllOption = false)
{
    $clientRoles = collect(config('userroles'))->slice(2, 3)->pluck('display_name', 'id');

    if (!$selectAllOption) {
        return $clientRoles;
    } else {
        $clientRoles     = $clientRoles->toArray();
        $clientRoles[-1] = 'Select all';
        ksort($clientRoles);
    }

    return $clientRoles;
}

/**
 * Get user division class.
 * @param bool $readAction
 * @return string
 */
function getUserDivClass(bool $readAction)
{
    return $readAction ? 'col-md-12' : 'col-md-6';
}

/**
 * @param bool $status
 * @return string
 */
function getStatus(bool $status)
{
    return ($status == 0) ? '<span class="label label-sm label-danger"> Inactive </span>' :
        '<span class="label label-sm label-success"> Active </span>';
}

/**
 * Check if the sidebar is active or not, checking the URI.
 * @param $menu
 * @return string
 */
function isSideBarActive($menu)
{
    return (request()->segment(2) == $menu) ? 'start active open' : '';
}


/**
 * Check if the submenu is active or not, checking the URI.
 * @param      $subMenu
 * @param null $class
 * @return string
 */
function isSubMenuActive($subMenu, $class = null)
{
    if (!$class) {
        return (request()->routeIs($subMenu) && request('class') == 0) ? 'start active open' : '';
    } else {
        return (request()->routeIs($subMenu) && request('class') == $class) ? 'start active open' : '';
    }
}

/**
 * Check if the user has the specific role or not.
 * @param string $role
 * @return bool
 */
function userHasRole(string $role)
{
    $entrustClass = app(\Zizaco\Entrust\Entrust::class);

    return ($entrustClass->hasRole($role)) ? true : false;
}

/**
 * Return exception message
 *
 * @param $message
 * @param $exception
 * @return string
 */
function getExceptionMessage($message, $exception)
{
    return sprintf($message.' because %s in file %s at line number %d', $exception->getMessage(), $exception->getFile(),
        $exception->getLine());
}

/**
 * Check if route is exist or not
 * @param string $routeName
 * @return mixed
 */
function routeHas(string $routeName)
{
    return Route::has($routeName);
}

/**
 * Returns the current user.
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
function currentUser()
{
    return auth()->user();
}

/**
 * return Form By id
 * @param int    $id
 * @param string $column
 * @return int
 */
function getFormById(int $id, string $column = 'name')
{
    $forms = array_pluck(config("forms"), $column, "id");

    return $forms[$id];
}

/**
 * Returns the current non admin user (finder / filler)
 * @return \App\EBP\Entities\User
 */
function currentNonAdminUser()
{
    return auth()->guard('front')->user();
}



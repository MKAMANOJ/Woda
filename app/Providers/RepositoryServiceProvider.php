<?php

namespace App\Providers;

use App\EBP\Repositories\ContactUsInfo\ContactUsInfoRepository;
use App\EBP\Repositories\ContactUsInfo\IContactUsInfoRepository;
use App\EBP\Repositories\EmailTemplates\EmailTemplateRepository;
use App\EBP\Repositories\EmailTemplates\IEmailTemplateRepository;
use App\EBP\Repositories\Gallery\Category\GalleryCategoryRepository;
use App\EBP\Repositories\Gallery\Category\IGalleryCategoryRepository;
use App\EBP\Repositories\Gallery\Image\GalleryImageRepository;
use App\EBP\Repositories\Gallery\Image\IGalleryImageRepository;
use App\EBP\Repositories\ImportantContact\Category\IImportantContactCategoryRepository;
use App\EBP\Repositories\ImportantContact\Category\ImportantContactCategoryRepository;
use App\EBP\Repositories\ImportantContact\Contact\IImportantContactRepository;
use App\EBP\Repositories\ImportantContact\Contact\ImportantContactRepository;
use App\EBP\Repositories\Notification\INotificationRepository;
use App\EBP\Repositories\Notification\NotificationRepository;
use App\EBP\Repositories\Staff\IStaffRepository;
use App\EBP\Repositories\Staff\StaffRepository;
use App\EBP\Repositories\Users\IRolesRepository;
use App\EBP\Repositories\Users\IUsersRepository;
use App\EBP\Repositories\Users\RolesRepository;
use App\EBP\Repositories\Users\UsersRepository;
use App\EBP\Repositories\File\File\IUploadedFileRepository;
use App\EBP\Repositories\File\File\UploadedFileRepository;
use App\EBP\Repositories\File\Category\FileCategoryRepository;
use App\EBP\Repositories\File\Category\IFileCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories = [
        IUsersRepository::class                    => UsersRepository::class,
        IRolesRepository::class                    => RolesRepository::class,
        IEmailTemplateRepository::class            => EmailTemplateRepository::class,
        INotificationRepository::class             => NotificationRepository::class,
        IGalleryCategoryRepository::class          => GalleryCategoryRepository::class,
        IGalleryImageRepository::class             => GalleryImageRepository::class,
        IStaffRepository::class                    => StaffRepository::class,
        IFileCategoryRepository::class             => FileCategoryRepository::class,
        IUploadedFileRepository::class             => UploadedFileRepository::class,
        IContactUsInfoRepository::class            => ContactUsInfoRepository::class,
        IImportantContactCategoryRepository::class => ImportantContactCategoryRepository::class,
        IImportantContactRepository::class         => ImportantContactRepository::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}

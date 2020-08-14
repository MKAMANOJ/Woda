<?php

namespace App\Domain\Front\Services\Notification;

use App\EBP\Repositories\Finder\IFinderRepository;
use App\EBP\Repositories\Notification\INotificationRepository;

/**
 * Class NotificationService
 * @package App\Domain\Front\Services\Notification
 */
class NotificationService
{
    /**
     * @var INotificationRepository
     */
    private $notificationRepository;
    /**
     * @var IFinderRepository
     */
    private $finderRepository;

    /**
     * NotificationService constructor.
     * @param INotificationRepository $notificationRepository
     * @param IFinderRepository       $finderRepository
     */
    public function __construct(INotificationRepository $notificationRepository, IFinderRepository $finderRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->finderRepository       = $finderRepository;
    }

    /**
     * Get all finder's notifications
     *
     * @param string $see
     * @return mixed
     */
    public function getAllNotification(string $see = null)
    {
        return $this->notificationRepository->getAllNotification($see);
    }

    /**
     * Mark all as read finder's notifications
     *
     * @return mixed
     */
    public function markAllAsRead()
    {
        return $this->notificationRepository->markAllAsRead();
    }

    /**
     * Count unread finer's notification
     *
     * @return mixed
     */
    public function countUnreadNotification()
    {
        return $this->notificationRepository->countUnreadNotification();
    }

    /**
     * Marks a notification as read.
     * @param array $request
     * @return mixed
     */
    public function markAsRead(array $request)
    {
        if (isset($request['notification-id'])) {
            return $this->notificationRepository->update(['is_read' => true], $request['notification-id']);
        }
    }
}

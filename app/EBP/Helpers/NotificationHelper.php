<?php

namespace App\EBP\Helpers;

use App\EBP\Repositories\Notification\INotificationRepository;

/**
 * Class NotificationHelper
 * @package App\EBP\Helpers
 */
class NotificationHelper
{
    /**
     * @var INotificationRepository
     */
    private $notificationRepository;

    /**
     * NotificationHelper constructor.
     * @param INotificationRepository $notificationRepository
     */
    public function __construct(INotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Create new notification
     *
     * @param int    $userId
     * @param string $type
     * @param string $notificationText
     * @param string $link
     * @param string $status
     * @return mixed
     */
    public function create(int $userId, string $type, string $notificationText, string $link, string $status)
    {
        return $this->notificationRepository->createNewNotification($userId, $type, $notificationText, $link, $status);
    }
}

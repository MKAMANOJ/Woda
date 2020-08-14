<?php

namespace App\EBP\Repositories\Notification;

/**
 * Interface INotificationRepository
 * @package App\EBP\Repositories\Notification
 */
interface INotificationRepository
{

    /**
     * get all finder's notifications
     *
     * @param string $see
     * @return mixed
     */
    public function getAllNotification(string $see = null);

    /**
     * mark all finder's notifications as read
     *
     * @return mixed
     */
    public function markAllAsRead();

    /**
     * count unread finder notification
     *
     * @return mixed
     */
    public function countUnreadNotification();

    /**
     * create new notification
     *
     * @param int    $userId
     * @param string $type
     * @param string $notificationText
     * @param string $link
     * @param string $status
     */
    public function createNewNotification(int $userId, string $type, string $notificationText, string $link, string $status);
}

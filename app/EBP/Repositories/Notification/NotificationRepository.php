<?php

namespace App\EBP\Repositories\Notification;

use App\EBP\Entities\Notification\Notification;
use App\EBP\Constants\Notification as NotificationConstants;
use App\EBP\Repositories\BaseRepository;

/**
 * Class NotificationRepository
 * @package App\EBP\Repositories\Notification
 */
class NotificationRepository extends BaseRepository implements INotificationRepository
{
    /**
     * @var int
     */
    protected $perPageNotifications = NotificationConstants::PER_PAGE;

    /**
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
     * get all finder's notifications
     *
     * @param string $see
     * @return mixed
     */
    public function getAllNotification(string $see = null)
    {
        $notifications = $this->model->select('id', 'type', 'notification_text', 'link', 'is_read', 'created_at', 'status')
            ->orderBy('created_at', 'desc');
        if ($see != 'all') {
            $notifications->where('is_read', false);
        }

        return $notifications->ofLoggedInUser()->paginate($this->perPageNotifications);
    }

    /**
     * Mark all finder's notifications as read
     *
     * @return mixed
     */
    public function markAllAsRead()
    {
        return $this->model->ofLoggedInUser()->update(['is_read' => true]);
    }

    /**
     * count unread finder notification
     *
     * @return mixed
     */
    public function countUnreadNotification()
    {
        return $this->model->ofLoggedInUser()->where('is_read', false)->count();
    }

    /**
     * create new notification
     *
     * @param int    $userId
     * @param string $type
     * @param string $notificationText
     * @param string $link
     * @param string $status
     */
    public function createNewNotification(int $userId, string $type, string $notificationText, string $link, string $status)
    {
        $insertData = [
            'user_id'           => $userId,
            'type'              => $type,
            'notification_text' => $notificationText,
            'link'              => $link,
            'status'            => $status,
        ];

        return $this->model->create($insertData);
    }
}

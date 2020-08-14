<?php

namespace App\Notifications;

use App\EBP\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegisteredSuccessfully extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    protected $user;
    /**
     *
     */
    protected $password;

    /**
     * Create a new notification instance.
     *
     * @param User   $user
     * @param string $password
     */
    public function __construct(User $user, string $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /** @var User $user */
        $user = $this->user;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject('Successfully created new admin account')
            ->greeting(sprintf('Hello %s', $user->name))
            ->line(sprintf('You have successfully registered to our system. Your current password is %s . Please activate your account.', $this->password))
            ->action('Click Here', route('activate.user', $user->activation_code))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

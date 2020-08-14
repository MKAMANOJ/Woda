<?php

namespace App\Notifications;

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as IlluminateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class EmailNotification
 * @package App\Notifications
 */
class EmailNotification extends IlluminateNotification implements ShouldQueue
{
    use Queueable;
    /**
     * @var
     */
    protected $name;
    /**
     * @var array|mixed
     */
    protected $replace;
    /**
     * @var bool
     */
    private $slug;
    /**
     * @var null
     */
    private $from;

    /**
     * Create a new notification instance.
     *
     * @param string $slug
     * @param array  $emailData
     */
    public function __construct(string $slug, array $emailData = null)
    {
        $this->slug    = $slug;
        $this->from    = $emailData['from'] ?? null;
        $this->replace = $emailData['replace'] ?? [];
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
        $emailTemplate = $this->compileEmailTemplate($notifiable);
        $content       = $emailTemplate->content;
        $email         = (new MailMessage)->subject($emailTemplate->subject)->view('mail.emailNotification',
            compact('content'));
        if ($this->from) {
            $email->from($this->from);
        }

        return $email;
    }

    /**
     * Get compiled email template
     *
     * @return mixed
     */
    private function compileEmailTemplate($notifiable)
    {
        $emailTemplate          = app(EmailTemplate::class)->where('slug', $this->slug)->firstOrFail();
        $emailTemplate->content = $this->replaceString($emailTemplate->content, $notifiable);

        return $emailTemplate;
    }

    /**
     * Replace string
     *
     * @param $content
     * @param $notifiable
     * @return mixed
     */
    private function replaceString($content, $notifiable)
    {
        $defaultStrings     = ["@name"];
        $defaultValues      = [$notifiable->name];
        $replaceableStrings = array_merge($defaultStrings, array_keys($this->replace));
        $actualValues       = array_merge($defaultValues, array_values($this->replace));

        $content = str_replace($replaceableStrings, $actualValues, $content);

        return $content;
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

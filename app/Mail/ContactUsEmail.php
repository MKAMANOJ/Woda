<?php

namespace App\Mail;

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ContactUsEmail
 * @package App\Mail
 */
class ContactUsEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var array
     */
    private $emailData;

    /**
     * @var
     */
    private $email;
    /**
     * @var array
     */
    private $emailConfig;
    /**
     * @var EmailTemplate
     */
    private $emailTemplate;

    /**
     * Create a new message instance.
     *
     * @param array         $emailData
     * @param EmailTemplate $emailTemplate
     * @param array         $emailConfig
     * @internal param array $data
     */
    public function __construct(array $emailData, EmailTemplate $emailTemplate, array $emailConfig)
    {
        $this->emailData = $emailData;
        $this->email     = str_replace(["@name", "@contact_no", "@email", "@comment"],
            [$emailData['name'], $emailData['contact_no'], $emailData['email'], $emailData['comment']],
            $emailTemplate->content);

        $this->emailConfig = $emailConfig;
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contactUs.contactUs')
            ->with(["emailContent" => $this->email])
            ->from($this->emailConfig['from'])
            ->to($this->emailConfig['to'])
            ->subject($this->emailTemplate->subject);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SenderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $senderMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $senderMessage)
    {
        $this->senderMessage = $senderMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contactUs.contactUs')
                    ->with(['senderMessage' => $this->senderMessage])
                    ->subject(config('email.subject'));
    }
}

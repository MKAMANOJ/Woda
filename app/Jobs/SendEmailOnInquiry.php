<?php

namespace App\Jobs;

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use App\Mail\ContactUsEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmailOnInquiry
 * @package App\Jobs
 */
class SendEmailOnInquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $emailData;
    /**
     * @var EmailTemplate
     */
    private $emailTemplate;

    /**
     * Create a new job instance.
     *
     * @param array $emailData
     * @param array $emailTemplate
     */
    public function __construct(array $emailData, array $emailTemplate)
    {
        $this->emailData     = $emailData;
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $systemAdminEmail     = getSetting("email");
        $emailConfigToAdmin   = [
            "to"   => $systemAdminEmail,
            "from" => $this->emailData['email'],
        ];
        $emailConfigToVisitor = [
            "to"   => $this->emailData['email'],
            "from" => $systemAdminEmail,
        ];
        Mail::send(new ContactUsEmail($this->emailData, $this->emailTemplate['toAdmin'], $emailConfigToAdmin));
        Mail::send(new ContactUsEmail($this->emailData, $this->emailTemplate['toVisitor'], $emailConfigToVisitor));
    }
}

<?php

use App\EBP\Entities\EmailTemplate\EmailTemplate;
use Illuminate\Database\Seeder;

/**
 * Class EmailTemplateTableSeeder
 */
class EmailTemplateTableSeeder extends Seeder
{
    /**
     * @var EmailTemplate
     */
    private $emailTemplate;

    /**
     * EmailTemplateTableSeeder constructor.
     * @param EmailTemplate $emailTemplate
     */
    public function __construct(EmailTemplate $emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**************************************
         *  Seed settings.
         **************************************/
        $emailTemplateList = [
            [
                'title'   => ' Activation Email',
                'slug'    => 'activation-email',
                'subject' => 'Activation Email',
                'content' => view('mail.templates.activationEmail'),
            ],
            [
                'title'   => ' Activation Email And Set Password',
                'slug'    => 'activation-email-set-password',
                'subject' => 'Activation Email And Set Password',
                'content' => view('mail.templates.activationEmailAndSetPassword'),
            ],
            [
                'title'   => 'Welcome Email',
                'slug'    => 'welcome-email',
                'subject' => '',
                'content' => view('mail.templates.welcome'),
            ],
            [
                'title'   => 'Forgotten Password',
                'slug'    => 'forgotten-password',
                'subject' => 'Password Reset',
                'content' => view('mail.templates.forgetPassword'),
            ],
            [
                'title'   => 'Password Change Notification',
                'slug'    => 'password-change-notification',
                'subject' => 'Password Changed Notification',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'Approved Website Listing (Supplier)',
                'slug'    => 'approved-website-listing-supplier',
                'subject' => 'Website Listing Approved',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'New Quote Notification (Supplier)',
                'slug'    => 'new-quote-notification-supplier',
                'subject' => 'New Quote',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'New Movement Notification (Supplier)',
                'slug'    => 'new-movement-notification-supplier',
                'subject' => 'New Movement',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'Approved Quote Notification (Customer)',
                'slug'    => 'approved-quote-notification-customer',
                'subject' => 'Quote Approved',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'Approved Movement Notification (Customer)',
                'slug'    => 'approved-movement-notification-customer',
                'subject' => 'Movement Approved',
                'content' => view('mail.templates.demo'),
            ],
            [
                'title'   => 'Contact Us',
                'slug'    => 'contact-us',
                'subject' => 'New Contact Message',
                'content' => view('mail.templates.clientContactUs'),
            ],
            [
                'title'   => 'Contact Us Thank you Email Template',
                'slug'    => 'contact-us-thank-you-email-template',
                'subject' => 'Thank you for contact us. We will get back to you soon',
                'content' => view('mail.templates.contactUs'),
            ],

        ];
        $this->emailTemplate->truncate();
        foreach ($emailTemplateList as $key => $emailTemplate) {
            if (!$this->emailTemplate->where('slug', $emailTemplate['slug'])->exists()) {
                $this->emailTemplate->create($emailTemplate);
            }
        }
    }
}

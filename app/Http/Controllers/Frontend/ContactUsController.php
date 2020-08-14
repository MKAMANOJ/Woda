<?php

namespace App\Http\Controllers\Frontend;

use App\EBP\Entities\HomePage\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\EBP\Entities\ContactUsInfo;
use App\EBP\Entities\User;
use App\Mail\SenderMail;
use Mail;
use App\Notifications\SenderMailNotification;
use Notification;

class ContactUsController extends Controller
{
    public function index()
    {
        App::setLocale(session()->get('checkLanguages'));
        $contactUs = app(ContactUsInfo::class)->first();

        return view('frontend.contact-us', compact('contactUs'));
    }

    public function sendMessage(Request $request)
    {
        $sender_message = [
        	'name' => $request->name,
	        'email' =>$request->email,
	        'phone' => $request->phone,
	        'address' => $request->address,
	        'message' => $request->message,
        ];

        if($sender_message) {
            Mail::to(config('email.email_address'))
                ->send(new SenderMail($sender_message));
            $users = app(User::class)->get();
            $sender_name =  $request->name;

            Notification::send($users, new SenderMailNotification($sender_name));
        }

        if ($sender_message) {
            $notification = array(
                'message'    => 'Thank You For Your  Co-operation. \n (सहयोगको लागि धन्यवाद)',
                'alert-type' => 'success'
            );
            return redirect()->route('frontend.contact-us')->with($notification);
        } else {
            $notification = array(
                'message'    => 'Internal Error, Please try again later.',
                'alert-type' => 'error'
            );           
            return redirect()->route('frontend.contact-us')->with($notification);
        }

        return view('frontend.contact-us', compact('contactUs'));
    }
}
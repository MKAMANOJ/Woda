<?php

namespace App\Http\Controllers\Admin\PushNotification;

use App\Domain\Admin\Requests\Introduction\PushNotificationRequest;
use App\Domain\Admin\Services\FCM\PushNotificationService;
use App\EBP\Entities\PushNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.pushNotification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PushNotificationRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PushNotificationRequest $request)
    {
        try {
            $notification = app(PushNotification::class)->create($request->all());
            app(PushNotificationService::class)->sendPushNotificationByTopic([
                'title'            => $notification->title,
                'text'             => $notification->description,
                'file_category_id' => 15,
                'key'              => $notification->id,
                'contentType'      => 'html',
            ]);

            flash('Notification Successfully Created.')->success();
        } catch (\Exception $exception) {
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
            logger()->info($exception->getMessage());
        }

        return redirect(route('push-notification.create'));
    }
}

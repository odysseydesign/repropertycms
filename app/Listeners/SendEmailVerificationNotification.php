<?php

namespace App\Listeners;

use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Log;

class SendEmailVerificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        try {
            $event->user->notify(new CustomVerifyEmailNotification($event->user));

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}

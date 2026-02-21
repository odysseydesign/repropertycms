<?php

namespace App\Listeners;

use App\Notifications\AdminRegisteredNotification;
use App\Notifications\AgentRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;
use Log;

class SendRegisteredNotification
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
        Log::info('Registered event fired.');

        try {
            $agent = $event->user;

            // Welcome email to agent
            $agent->notify(new AgentRegistered($agent));

            Notification::route('mail', 'email@riemailtask.com') // or use an admin model here.
                ->notify(new AdminRegisteredNotification($agent));

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}

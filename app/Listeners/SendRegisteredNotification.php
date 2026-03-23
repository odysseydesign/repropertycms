<?php

namespace App\Listeners;

use App\Models\Backend\Admin;
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

            $adminEmail = Admin::first()?->email;
            if ($adminEmail) {
                Notification::route('mail', $adminEmail)
                    ->notify(new AdminRegisteredNotification($agent));
            }

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}

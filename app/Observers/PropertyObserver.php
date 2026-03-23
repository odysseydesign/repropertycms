<?php

namespace App\Observers;

use App\Models\Backend\Admin;
use App\Models\Properties;
use App\Notifications\PropertyCreated;
use Illuminate\Support\Facades\Notification;
use Log;

class PropertyObserver
{
    /**
     * Handle the Properties "created" event.
     *
     * @return void
     */
    public function created(Properties $properties)
    {
        Log::info('New Property Observer fired.');
        $agent = $properties->agents;
        $data = [
            'name' => $properties->name,
            'address_line_1' => $properties->address_line_1,
            'address_line_2' => $properties->address_line_2,
            'city' => $properties->city,
            'state' => $properties->state,
            'country' => $properties->country,
            'url' => $properties->unique_url,
            'agent' => $agent,
        ];
        try {

            $adminEmail = Admin::first()?->email;
            if ($adminEmail) {
                Notification::route('mail', $adminEmail)
                    ->notify(new PropertyCreated($data));
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * Handle the Properties "updated" event.
     *
     * @return void
     */
    public function updated(Properties $properties)
    {
        //
    }

    /**
     * Handle the Properties "deleted" event.
     *
     * @return void
     */
    public function deleted(Properties $properties)
    {
        //
    }

    /**
     * Handle the Properties "restored" event.
     *
     * @return void
     */
    public function restored(Properties $properties)
    {
        //
    }

    /**
     * Handle the Properties "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Properties $properties)
    {
        //
    }
}

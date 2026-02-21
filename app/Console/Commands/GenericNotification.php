<?php

namespace App\Console\Commands;

use App\Models\Agents;
use Illuminate\Console\Command;

class GenericNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $agent = Agents::find(23);
        $notification = new \App\Notifications\GenericNotification([
            'message' => 'This is a test notification from Tinker!', // Customize the message
            'link' => '/agent/dashboard', // Optional: Add a link to the notification
            'type' => 'info', // Optional: Add a notification type for styling/filtering
        ]);
        $agent->notify($notification);
    }
}

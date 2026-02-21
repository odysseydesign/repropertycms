<?php

namespace App\Console\Commands;

use App\Models\Agents;
use Illuminate\Console\Command;

class RenewReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agents:renew-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Reminder for renewal to Agent';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $agent = Agents::find(18);

        $agent->notify(new \App\Notifications\RenewalReminder);
        die();

        // send reminder email to agent first notification 7 days before, second notification 3 days before & third notificaiton 1 days before subscription expires.
        \App\Models\Subscription::where('current_period_end', '>', now()->subDays(7))
            ->where('current_period_end', '<', now()->addDays(1))
            ->chunk(100, function ($subscriptions) {
                foreach ($subscriptions as $subscription) {
                    $agent = $subscription->agent;
                    $daysLeft = $subscription->current_period_end->diffInDays(now());
                    if ($daysLeft == 7 || $daysLeft == 3 || $daysLeft == 1) {
                        $agent->notify(new \App\Notifications\RenewalReminder($daysLeft));
                    }
                }
            });
    }
}

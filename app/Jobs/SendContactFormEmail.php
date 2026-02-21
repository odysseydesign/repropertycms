<?php

namespace App\Jobs;

use App\Mail\ContactAgentMail;
use App\Mail\ContactUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactFormEmail implements ShouldQueue
{
    use Queueable;

    protected $user;

    protected $agent;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $agent)
    {
        $this->user = $user;
        $this->agent = $agent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send email to the user
        Mail::to($this->user['email'])
            ->send(new ContactUserMail($this->user, $this->agent));

        // Send email to the agent
        Mail::to($this->agent->email)
            ->replyTo($this->user['email'])  // Use user's email for reply-to
            ->send(new ContactAgentMail($this->user, $this->agent));
    }
}

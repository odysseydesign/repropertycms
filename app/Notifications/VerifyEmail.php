<?php

namespace App\Notifications;

//use AWS\CRT\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class VerifyEmail extends Notification
{
    use Queueable;

    protected $agent;
    protected $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($agent, $url = null)
    {
        $this->agent = $agent;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        Log::error("Verify Email");
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->view('mail.verify_email', ['agent' => $this->agent, 'url' => $this->url]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

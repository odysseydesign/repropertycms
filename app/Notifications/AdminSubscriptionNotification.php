<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSubscriptionNotification extends Notification
{
    use Queueable;

    protected $agent;

    protected $subscription;

    /**
     * Create a new notification instance.
     */
    public function __construct($agent, $subscription)
    {
        $this->agent = $agent;
        $this->subscription = $subscription;
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
        return (new MailMessage)
            ->subject('New Subscription')
            ->line('Agent '.$this->agent->first_name.' '.$this->agent->last_name.' has subscribed to '.$this->subscription->metadata->plan.'.')
            ->line('Subscription ID: '.$this->subscription->id)
            ->line('Agent ID: '.$this->agent->id);
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

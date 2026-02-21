<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSubscriptionExpired extends Notification
{
    use Queueable;

    protected $agent;

    /**
     * Create a new notification instance.
     */
    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Agent Subscription Expired')
            ->line('Agent '.$this->agent->first_name.' '.$this->agent->last_name.' subscription has expired.')
            ->line('Agent Email: '.$this->agent->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Agent Subscription Expired',
            'message' => $this->agent->first_name.' '.$this->agent->last_name.' subscription has expired.',
            'icon' => 'x-circle',
            'icon_color' => 'text-red-500',
            'url' => route('admin.agents.show', $this->agent->id),
        ];
    }
}

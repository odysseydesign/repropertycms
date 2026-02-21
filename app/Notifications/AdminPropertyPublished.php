<?php

namespace App\Notifications;

use App\Models\Properties;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminPropertyPublished extends Notification
{
    use Queueable;

    private Properties $property;

    /**
     * Create a new notification instance.
     */
    public function __construct(Properties $property)
    {
        $this->property = $property;
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
            ->subject('New Property Published')
            ->line('Hello Admin,')
            ->line('A new property has been published.')
            ->action('View Property', url($this->property->unique_url))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Property Published',
            'message' => 'A new property has been published.',
            'link' => url($this->property->unique_url),
            'button' => 'View Property',
        ];
    }
}

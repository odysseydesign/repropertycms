<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyCreated extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
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
            ->subject('Agent created a new Property: '.$this->data['name']) // More descriptive subject
            ->greeting('Hello Admin,')
            ->line('Agent '.$this->data['agent']->name.' created a new property:') // Agent name included
            ->line('Property Name: '.$this->data['name'])
            ->line('Address: '.$this->data['address_line_1'].', '.$this->data['address_line_2'])
            ->line('City: '.$this->data['city'].', State: '.$this->data['state'].', Country: '.$this->data['country'])
            ->action('View Property', url($this->data['url'])) // Use url helper to generate full URL
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
            //
        ];
    }
}

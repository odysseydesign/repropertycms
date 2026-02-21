<?php

namespace App\Livewire\Agent;

use Livewire\Component;

class NotificationCount extends Component
{
    public $agent;

    public $notificationCount; // Add a public property

    public function mount()
    {
        $this->agent = auth()->user();
        $this->updateNotificationCount(); // Initialize the count
    }

    public function updateNotificationCount()
    {
        $this->notificationCount = $this->agent->unreadNotifications->count();
    }

    public function render()
    {
        return view('livewire.agent.notification-count');
    }
}

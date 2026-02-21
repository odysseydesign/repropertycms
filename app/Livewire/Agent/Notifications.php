<?php

namespace App\Livewire\Agent;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[On('refresh')]
class Notifications extends Component
{
    use WithPagination;

    public $agent;

    public $perPage = 10;

    public function markAsRead($notificationId)
    {
        $notification = $this->agent->notifications()->find($notificationId);

        if ($notification && ! $notification->read_at) {
            $notification->markAsRead();
            $this->dispatch('refresh'); // Optional: If you want to update something on the frontend without a full page reload.
        }
    }

    public function markAllAsRead()
    {
        $this->agent->unreadNotifications->markAsRead();
        $this->dispatch('refresh'); // Optional: If you want to update something on the frontend.
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        $notifications = $this->agent->notifications()->paginate($this->perPage);

        return view('livewire.agent.notifications', compact('notifications'));
    }
}

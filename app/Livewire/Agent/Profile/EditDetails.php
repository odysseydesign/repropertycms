<?php

namespace App\Livewire\Agent\Profile;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class EditDetails extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $agent;

    public $first_name;

    public $last_name;

    public $email;

    #[On('open-edit-details')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
    }

    public function save()
    {
        $this->agent->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);

        $this->alert('success', 'Basic Details Updated Successfully!', [
            'toast' => true,
        ]);
        $this->dispatch('refresh');
        $this->show = false;
    }

    public function mount()
    {
        $this->agent = auth()->user();
        $this->first_name = $this->agent->first_name;
        $this->last_name = $this->agent->last_name;
        $this->email = $this->agent->email;
    }

    public function render()
    {
        return view('livewire.agent.profile.edit-details');
    }
}

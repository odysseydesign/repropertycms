<?php

namespace App\Livewire\Agent\Profile;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use WireElements\Pro\Components\Modal\Modal;

class EditDetails extends Modal
{
    use LivewireAlert;

    public $agent;

    public $first_name;

    public $last_name;

    public $email;

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
        $this->close();
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

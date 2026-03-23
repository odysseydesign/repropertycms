<?php

namespace App\Livewire\Agent\Profile;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
class Index extends Component
{
    use LivewireAlert;

    public $agent;

    public function doDeleteProfileImage()
    {
        deleteS3Image($this->agent->profile_image);
        $this->agent->update(['profile_image' => null]);
        $this->alert('success', 'Profile Image Removed Successfully!', ['toast' => true]);
        $this->dispatch('refresh');
    }

    public function doDeleteLogoImage()
    {
        deleteS3Image($this->agent->logo_image);
        $this->agent->update(['logo_image' => null]);
        $this->alert('success', 'Logo Image Removed Successfully!', ['toast' => true]);
        $this->dispatch('refresh');
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        return view('livewire.agent.profile.index');
    }
}

<?php

namespace App\Livewire\Agent\Profile;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSocialMedia extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $agent;

    public $facebook_profile;

    public $instagram_profile;

    public $twitter_profile;

    public $linkedin_profile;

    #[On('open-edit-social-media')]
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
            'facebook_profile' => $this->facebook_profile,
            'instagram_profile' => $this->instagram_profile,
            'twitter_profile' => $this->twitter_profile,
            'linkedin_profile' => $this->linkedin_profile,
        ]);
        $this->alert('success', 'Social media links updated!');
        $this->dispatch('refresh');
        $this->show = false;
    }

    public function mount()
    {
        $this->agent = auth()->user();
        $this->facebook_profile = $this->agent->facebook_profile;
        $this->instagram_profile = $this->agent->instagram_profile;
        $this->twitter_profile = $this->agent->twitter_profile;
        $this->linkedin_profile = $this->agent->linkedin_profile;
    }

    public function render()
    {
        return view('livewire.agent.profile.edit-social-media');
    }
}

<?php

namespace App\Livewire\Agent\Profile;

use App\Models\Countries;
use App\Models\States;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
class Index extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;

    public $agent;

    public $agent_address;

    public $states;

    public $countries;

    public function deleteProfileImage()
    {
        $this->askForConfirmation(
            callback: function () {
                deleteS3Image($this->agent->profile_image);
                $this->agent->update([
                    'profile_image' => null,
                ]);

                $this->alert('success', 'Profile Image Removed Successfully!', [
                    'toast' => true,
                ]);

                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Profile Image'),
                'message' => __('Are you sure you want to delete this profile image?'),
                'confirm' => __('Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }

    public function deleteLogoImage()
    {
        $this->askForConfirmation(
            callback: function () {
                deleteS3Image($this->agent->logo_image);
                $this->agent->update([
                    'logo_image' => null,
                ]);

                $this->alert('success', 'Logo Image Removed Successfully!', [
                    'toast' => true,
                ]);

                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Logo Image'),
                'message' => __('Are you sure you want to delete this logo image?'),
                'confirm' => __('Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
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

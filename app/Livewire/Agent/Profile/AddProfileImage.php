<?php

namespace App\Livewire\Agent\Profile;

use Illuminate\Http\File;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use WireElements\Pro\Components\Modal\Modal;

class AddProfileImage extends Modal
{
    use LivewireAlert;
    use WithFileUploads;

    public $agent;

    public $thumbnail;

    public function save()
    {
        if (is_array($this->thumbnail)) {
            foreach ($this->thumbnail as $file) {
                $image = new File($file['path']);
                $path = uploadS3Image('profile_image', $image);
                $this->agent->update([
                    'profile_image' => $path,
                ]);
            }

        } else {
            if(isset($this->thumbnail)) {
                $image = new File($this->thumbnail['path']);
                $path = uploadS3Image('profile_image', $image);
                $this->agent->update([
                    'profile_image' => $path,
                ]);
                $this->alert('success', 'Profile Image added successfully.');
            }else {
                $this->alert('error', 'No Image is Uploaded, Please upload image.');
            }
        }

        $this->dispatch('refresh');
        $this->close();
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        return view('livewire.agent.profile.add-profile-image');
    }
}

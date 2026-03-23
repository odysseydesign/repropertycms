<?php

namespace App\Livewire\Agent\Profile;

use Illuminate\Http\File;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddLogoImage extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public bool $show = false;

    public $agent;

    public $thumbnail;

    #[On('open-add-logo-image')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset('thumbnail');
    }

    public function save()
    {
        // Validate files server-side
        $this->validate([
            'thumbnail.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        if (is_array($this->thumbnail)) {
            foreach ($this->thumbnail as $file) {
                // Additional MIME type verification
                if (!$this->validateMimeType($file, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                    $this->alert('error', 'Invalid file type detected. Only image files are allowed.');
                    return;
                }

                $image = new File($file['path']);
                $path = uploadS3Image('logo_image', $image);
                $this->agent->update([
                    'logo_image' => $path,
                ]);
            }
            $this->alert('success', 'Logo Image added successfully.');
        } else {
            if(isset($this->thumbnail)) {
                // Additional MIME type verification
                if (!$this->validateMimeType($this->thumbnail, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                    $this->alert('error', 'Invalid file type detected. Only image files are allowed.');
                    return;
                }

                $image = new File($this->thumbnail['path']);
                $path = uploadS3Image('logo_image', $image);
                $this->agent->update([
                    'logo_image' => $path,
                ]);
                $this->alert('success', 'Logo Image added successfully.');
            }else {
                $this->alert('error', 'No Image is Uploaded, Please upload image.');
            }
        }

        $this->dispatch('refresh');
        $this->show = false;
        $this->reset('thumbnail');
    }

    /**
     * Validate file MIME type to prevent spoofing
     */
    private function validateMimeType($file, array $allowedMimeTypes): bool
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['path']);
        finfo_close($finfo);

        return in_array($mimeType, $allowedMimeTypes);
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        return view('livewire.agent.profile.add-logo-image');
    }
}

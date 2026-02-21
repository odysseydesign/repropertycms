<?php

namespace App\Livewire\PhotoLibrary;

use App\Models\Properties;
use App\Models\Property_images;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
class Index extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;

    public $property;

    public $property_images;

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function deleteImage($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
                $property_image = Property_images::find($id);
                if ($property_image->file_name) {
                    deleteS3Image($property_image->file_name);
                }
                if ($property_image->thumb) {
                    deleteS3Image($property_image->thumb);
                }
                if ($property_image->small) {
                    deleteS3Image($property_image->small);
                }
                $property_image->delete();

                $this->dispatch('refresh');

                $this->alert('success', 'Image deleted successfully.', [
                    'toast' => true,
                ]);
                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Image'),
                'message' => __('Are you sure you want to delete this image?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }

    public function render()
    {
        $this->property_images = Property_images::where('property_id', '=', $this->property->id)->get();

        return view('livewire.photo-library.index');
    }
}

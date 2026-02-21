<?php

namespace App\Livewire\PhotoLibrary;

use App\Models\Properties;
use App\Models\Property_images;
use Illuminate\Http\File;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use WireElements\Pro\Components\Modal\Modal;

class AddNewImage extends Modal
{
    use LivewireAlert;
    use WithFileUploads;

    public $property;

    public $thumbnail;

    public function save()
    {
        if (is_array($this->thumbnail)) {
            foreach ($this->thumbnail as $file) {
                $image = new File($file['path']);
                $path = uploadS3Image('property_images', $image);
				$thumb_path = uploadS3ImageThumb('property_images_thumb', $image, env('THUMB_WIDTH'));

                $property_image = new Property_images;
                $property_image->property_id = $this->property->id;
                $property_image->file_name = $path;
                $property_image->thumb = $thumb_path;
                $property_image->save();
            }
        } else {
            if(isset($this->thumbnail['path'])) {
                $image = new File($this->thumbnail['path']);
                $path = uploadS3Image('property_images', $image);
                $thumb_path = uploadS3ImageThumb('property_images_thumb', $image, env('THUMB_WIDTH'));
                $property_image = new Property_images;
                $property_image->property_id = $this->property->id;
                $property_image->file_name = $path;
                $property_image->thumb = $thumb_path;
                $property_image->save();
            }
        }

        $this->alert('success', 'Image added successfully.');

        $this->dispatch('refresh');
        $this->close();
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        return view('livewire.photo-library.add-new-image');
    }
}

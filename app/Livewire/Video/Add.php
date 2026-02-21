<?php

namespace App\Livewire\Video;

use App\Enums\VideoType;
use App\Models\Properties;
use App\Models\Property_videos;
use BenSampo\Embed\Rules\EmbeddableUrl;
use BenSampo\Embed\Services\Vimeo;
use BenSampo\Embed\Services\YouTube;
use Illuminate\Http\UploadedFile;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use WireElements\Pro\Components\Modal\Modal;

class Add extends Modal
{
    use LivewireAlert;
    use WithFileUploads;

    public $property;

    public $showUploadOption = 'Youtube';

    public $video_url;

    public $video_type;

    public $videos;

    public function save()
    {
        if ($this->showUploadOption == 'Youtube') {
            $this->validate([
                'video_url' => [
                    'required',
                    (new EmbeddableUrl)->allowedServices([
                        YouTube::class,
                    ]),
                ],
            ]);
            $this->video_type = VideoType::YouTube;
        } elseif ($this->showUploadOption == 'Vimeo') {
            $this->validate([
                'video_url' => [
                    'required',
                    (new EmbeddableUrl)->allowedServices([
                        Vimeo::class,
                    ]),
                ],
            ]);
            $this->video_type = VideoType::Vimeo;
        } else {

            //            $this->validate([
            //                'videos' => 'required|mimes:mp4,mov,ogg,jpg',
            //            ]);

            foreach ($this->videos as $video) {
                $laravelFile = new UploadedFile(
                    $video['path'],
                    $video['name'],
                    $video['type'] ?? 'image/jpeg',
                    null,
                    true
                );
                $path = uploadS3Image('property_videos', $laravelFile);
            }

            $this->video_url = $path ?? '';
            $this->video_type = VideoType::Dropzone;

            $this->reset('videos');
        }

        $property_video = new Property_videos;
        $property_video->property_id = $this->property->id;
        $property_video->video_type = $this->video_type;
        $property_video->video_url = $this->video_url;
        $property_video->save();

        $this->alert('success', 'Property Video added successfully.');

        $this->dispatch('refresh');
        $this->close();
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        return view('livewire.video.add');
    }
}

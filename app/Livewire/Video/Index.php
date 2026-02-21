<?php

namespace App\Livewire\Video;

use App\Models\Properties;
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

    public $property_videos;

    public $property_matterports;

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        $this->property_videos = $this->property->property_videos;
        $this->property_matterports = $this->property->property_matterports;

        return view('livewire.video.index');
    }

    public function deleteVideo($video_id)
    {
        $this->askForConfirmation(
            callback: function () use ($video_id) {
                $this->property->property_videos()->where('id', $video_id)->delete();
                $this->alert('success', 'Property Video deleted successfully!', [
                    'toast' => true,
                ]);
                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Video'),
                'message' => __('Are you sure you want to delete this video?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }
}

<?php

namespace App\Livewire\Video;

use App\Models\Properties;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
class Index extends Component
{
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

    public function doDeleteVideo($video_id)
    {
        $this->property->property_videos()->where('id', $video_id)->delete();
        $this->alert('success', 'Property Video deleted successfully!', ['toast' => true]);
        $this->dispatch('refresh');
    }
}

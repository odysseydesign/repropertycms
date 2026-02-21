<?php

namespace App\Livewire\Agent\Topbar;

use App\Enums\BannerType;
use App\Models\Properties;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
class Video extends Component
{
    use LivewireAlert;

    public $property;

    public $property_video;

    public $property_header;

    public function mount(Properties $property)
    {
        $this->property = $property;
        $this->property_video = $this->property->property_videos->where('main_video', 1)->first();
        $this->property_header = $this->property->main_section == BannerType::Video;
    }

    public function updatedPropertyHeader($value)
    {
        if ($value) {
            $this->property->update(['main_section' => BannerType::Video]);

            $this->alert('success', 'Property Banner Set as Video Successfully', [
                'toast' => true,
            ]);
        } else {
            $this->property->update(['main_section' => null]);
            $this->alert('success', 'Video removed from Property Banner', [
                'toast' => true,
            ]);
        }

        $this->dispatch('refresh');
    }

    public function render()
    {

        return view('livewire.agent.topbar.video');
    }
}

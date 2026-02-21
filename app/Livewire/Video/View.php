<?php

namespace App\Livewire\Video;

use App\Models\Properties;
use App\Models\Property_videos;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use WireElements\Pro\Components\Modal\Modal;

class View extends Modal
{
    use LivewireAlert;

    public $property;

    public $property_video;

    public $display_on = 'both';

    public function updatedDisplayOn($value)
    {
        switch ($value) {
            case 'both':
                $this->property->property_videos()->update(['main_video' => 0, 'featured' => 0]);
                Property_videos::where('property_id', $this->property->id)->update([
                    'main_video' => 1,
                    'featured' => 1,
                ]);
                $this->alert('success', 'Property Video set as cover & featured.');
                break;
            case 'cover':
                $this->property->property_videos()->update(['main_video' => 0]);
                Property_videos::where('property_id', $this->property->id)->update([
                    'main_video' => 1,
                    'featured' => 0,
                ]);
                $this->alert('success', 'Property Video set as '.$value);
                break;
            case 'featured':
                $this->property->property_videos()->update(['featured' => 0]);
                Property_videos::where('property_id', $this->property->id)->update([
                    'main_video' => 0,
                    'featured' => 1,
                ]);
                $this->alert('success', 'Property Video set as '.$value);
                break;
            default:
                $this->property_video->refresh(); //Reverts back to the DB state
                break;

        }

        $this->dispatch('refresh');
    }

    public function mount(Properties $property, Property_videos $property_video)
    {
        $this->property = $property;
        $this->property_video = $property_video;
        $this->display_on = $this->getInitialDisplayOnValue();
    }

    public function render()
    {
        return view('livewire.video.view');
    }

    private function getInitialDisplayOnValue(): string
    {
        if ($this->property_video->featured && $this->property_video->main_video) {
            return 'both';
        } elseif ($this->property_video->main_video) {
            return 'cover';
        } elseif ($this->property_video->featured) {
            return 'featured';
        } else {
            return '';
        }
    }
}

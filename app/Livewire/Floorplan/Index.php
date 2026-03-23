<?php

namespace App\Livewire\Floorplan;

use App\Models\Properties;
use App\Models\PropertyFloorplans;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
#[On('refresh_hotspot')]
class Index extends Component
{
    use LivewireAlert;

    public $property;
    public $property_floorplans;

    public function doDeleteFloorplan($id)
    {
        $floorplan = PropertyFloorplans::find($id);

        foreach ($floorplan->hotspots as $hotspot) {
            $hotspot->propertyImages()->detach();
            $hotspot->delete();
        }

        $floorplan->hotspots()->delete();

        deleteS3Image($floorplan->file_name);
        deleteS3Image($floorplan->thumb);

        $floorplan->delete();

        $this->dispatch('refresh');
        $this->dispatch('reinitDropzone');

        $this->alert('success', 'Floor Plan is Deleted !', ['toast' => true]);
    }

    public function updateOrder($list)
    {
        foreach ($list as $item) {
            PropertyFloorplans::find($item['value'])->update(['sort_order' => $item['order']]);
        }
        $this->dispatch('refresh');
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        $this->property_floorplans = $this->property->property_floorplans()->orderBy('sort_order')->get();
        return view('livewire.floorplan.index');
    }
}

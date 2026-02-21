<?php

namespace App\Livewire\Floorplan;

use App\Models\Properties;
use App\Models\PropertyFloorplans;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
#[On('refresh_hotspot')]
class Index extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;

    public $property;

    public $property_floorplans;

    public function deleteFloorplan($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
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

                $this->alert('success', 'Floor Plan is Deleted !', [
                    'toast' => true,
                ]);
            },
            prompt: [
                'title' => __('Delete Floor Plan'),
                'message' => __('Are you sure you want to delete this Floor Plan?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
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

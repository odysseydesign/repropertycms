<?php

namespace App\Livewire\Agent\Topbar;

use App\Models\Properties;
use App\Models\Property_images;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use WireElements\Pro\Components\Modal\Modal;

#[On('refresh')]
class Image extends Modal
{
    use LivewireAlert;

    public $property_images;

    public $property;

    public function saveFeatureImage($image_id)
    {
        $this->property->update(['featured_image' => $image_id]);
        $this->alert('success', 'Feature Image Successfully Selected!');
        $this->dispatch('refresh');
        $this->dispatch('refresh')->to(Choose::class);
        $this->close();
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function render()
    {
        $this->property_images = Property_images::where('property_id', $this->property->id)->get();

        return view('livewire.agent.topbar.image');
    }
}

<?php

namespace App\Livewire\Map;

use App\Models\Properties;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
class Index extends Component
{
    public $property;

    public $property_image;

    public $url;

    public $latitude;

    public $longitude;

    public $address;

    public $markerImg;

    #[On('mapUpdated')]
    public function mapUpdated()
    {
        $this->property = Properties::find($this->property->id);

        $url = $this->property->address_line_1.' '.$this->property->address_line_2.' '.$this->property->city.' '.(isset($this->property->state) ? $this->property->state->name : ' ').' ';
        $url .= is_null($this->property->country) ? 'United States' : $this->property->country->name;
        $url .= $this->property->zip;
        $this->url = urlencode($url);

        $this->dispatch('refresh');
        $this->dispatch('mapUpdatedJs', ['address' => $this->url]);
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
        $this->property_image = $property->propertyImages->first();

		if ($this->property_image){
			$this->markerImg = $this->property_image->file_name;
		}

        $url = $this->property->address_line_1.' '.$this->property->address_line_2.' '.$this->property->city.' '.(isset($this->property->state) ? $this->property->state->name : ' ').' ';
        $url .= is_null($this->property->country) ? 'United States' : $this->property->country->name;
        $url .= $this->property->zip;
        $this->url = urlencode($url);
    }

    public function render()
    {

        return view('livewire.map.index');
    }
}

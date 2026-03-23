<?php

namespace App\Livewire\Map;

use App\Models\Properties;
use App\Models\States;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateMap extends Component
{
    public bool $show = false;

    public $property;

    public $address_line_1;

    public $address_line_2;

    public $city;

    public $state;

    public $zip;

    public $country = 'United States';

    public $states;

    #[On('open-update-map')]
    public function openModal(int $propertyId): void
    {
        $this->property = Properties::find($propertyId);
        $this->states = States::pluck('name', 'state_id')->toArray();

        $this->address_line_1 = $this->property->address_line_1;
        $this->address_line_2 = $this->property->address_line_2;
        $this->city = $this->property->city;
        $this->state = $this->property->state_id;
        $this->zip = $this->property->zip;
        $this->country = $this->property->country->name ?? 'United States';
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
    }

    public function save()
    {
        $this->property->update([
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state_id' => $this->state,
            'zip' => $this->zip,
        ]);

        session()->flash('success', 'Address updated successfully!');

        $this->dispatch('mapUpdated');

        $this->show = false;
    }

    public function render()
    {
        return view('livewire.map.update-map');
    }
}

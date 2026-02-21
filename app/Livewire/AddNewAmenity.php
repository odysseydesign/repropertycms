<?php

namespace App\Livewire;

use WireElements\Pro\Components\Modal\Modal;

class AddNewAmenity extends Modal
{
    public $add_amenity;

    public function save()
    {
        $this->dispatch('add_new_amenity', value: $this->add_amenity);

        $this->close();
    }

    public function render()
    {
        return view('livewire.add-new-amenity');
    }
}

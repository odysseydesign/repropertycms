<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class AddNewAmenity extends Component
{
    public bool $show = false;

    public $add_amenity;

    #[On('open-add-new-amenity')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset('add_amenity');
    }

    public function save()
    {
        $this->dispatch('add_new_amenity', value: $this->add_amenity);

        $this->show = false;
        $this->reset('add_amenity');
    }

    public function render()
    {
        return view('livewire.add-new-amenity');
    }
}

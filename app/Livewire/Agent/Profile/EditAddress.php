<?php

namespace App\Livewire\Agent\Profile;

use App\Models\Agent_addresses;
use App\Models\Countries;
use App\Models\States;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAddress extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $agent;

    public $agent_address;

    public $states;

    public $countries;

    public $business_name;

    public $address;

    public $city;

    public $state_id;

    public $zip;

    public $country_id;

    public $phone;

    #[On('open-edit-address')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'business_name' => 'required|string|max:100',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state_id' => 'required|exists:states,state_id',
            'zip' => 'required|string|max:10',
            'country_id' => 'required|exists:countries,country_id',
            'phone' => 'required|string|max:50',
        ]);

        if ($this->agent_address) {
            // Update existing address
            $this->agent_address->update($validatedData);
        } else {
            // Create a new address
            $validatedData['agent_id'] = $this->agent->id;
            Agent_addresses::create($validatedData);
        }

        $this->alert('success', 'Address Updated Successfully!', [
            'toast' => true,
        ]);

        $this->dispatch('refresh'); // Refresh the parent component
        $this->show = false;
    }

    public function mount()
    {
        $this->agent = auth()->user();
        $this->agent_address = $this->agent->agent_address;
        $this->states = States::pluck('name', 'state_id')->toArray();
        $this->countries = Countries::pluck('name', 'country_id')->toArray();
        if ($this->agent_address) {
            $this->business_name = $this->agent_address->business_name;
            $this->address = $this->agent_address->address;
            $this->city = $this->agent_address->city;
            $this->state_id = $this->agent_address->state_id;
            $this->zip = $this->agent_address->zip;
            $this->country_id = $this->agent_address->country_id;
            $this->phone = $this->agent_address->phone;
        } else {
            $this->country_id = 230;
        }
    }

    public function render()
    {
        return view('livewire.agent.profile.edit-address');
    }
}

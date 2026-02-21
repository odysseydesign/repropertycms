<?php

namespace App\Livewire\Agent\Topbar;

use App\Enums\BannerType;
use App\Models\Properties;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh')]
class Choose extends Component
{
    use LivewireAlert;

    public $property;

    public $property_header;

    public $property_image;

    public function updatedPropertyHeader($value)
    {
        if ($value) {
            $this->property->update(['main_section' => BannerType::Image]);

            $this->alert('success', 'Property Banner Set as Image Successfully', [
                'toast' => true,
            ]);
        } else {
            $this->property->update(['main_section' => null]);
            $this->alert('success', 'Image removed from Property Banner', [
                'toast' => true,
            ]);
        }

        $this->dispatch('refresh');
    }

    public function mount(Properties $property)
    {
        $this->property = $property;
        $this->property_header = $this->property->main_section == BannerType::Image;
    }

    public function render()
    {
        $this->property_image = $this->property->property_images->where('id', $this->property->featured_image)->first();

        return view('livewire.agent.topbar.choose');
    }
}

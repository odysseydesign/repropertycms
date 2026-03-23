<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Plan as StripePlan;
use Stripe\Stripe;

class Create extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $plan_name;

    public $price;

    public $interval = 'month';

    public $credits;

    #[On('open-create-plan')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['plan_name', 'price', 'credits']);
        $this->interval = 'month';
    }

    public function save()
    {
        $this->validate([
            'plan_name' => ['required', 'string', 'max:255', Rule::unique('plans', 'name')],
            'price'     => ['required', 'numeric', 'min:1'],
            'credits'   => ['required', 'numeric', 'min:1'],
            'interval'  => ['required', 'in:month,year'],
        ]);

        try {
            Stripe::setApiKey(config('stripe.api_keys.secret_key'));

            $stripePlan = StripePlan::create([
                'amount'   => $this->price * 100,
                'currency' => 'usd',
                'interval' => $this->interval,
                'product'  => ['name' => $this->plan_name],
            ]);

            Plan::create([
                'name'           => $this->plan_name,
                'price'          => $this->price,
                'stripe_plan_id' => $stripePlan->id,
                'interval'       => $this->interval,
                'credits'        => $this->credits,
            ]);

            $this->show = false;
            $this->reset(['plan_name', 'price', 'credits']);
            $this->interval = 'month';

            $this->dispatch('refresh');
            $this->alert('success', 'Plan created successfully.');

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.plans.create');
    }
}

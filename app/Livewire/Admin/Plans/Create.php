<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Stripe\Plan as StripePlan;
use Stripe\Stripe;
use WireElements\Pro\Components\Modal\Modal;

#[On('refresh')]
class Create extends Modal
{
    use LivewireAlert;

    public $plan_name;

    public $price;

    public $interval = 'month'; // Default interval

    public $credits;

    public function save()
    {
        $this->validate([
            'plan_name' => ['required', 'string', 'max:255', Rule::unique('plans', 'name')],
            'price' => ['required', 'numeric', 'min:1'],
            'credits' => ['required', 'numeric', 'min:1'],
            'interval' => ['required', 'in:month,year'], // Validate interval
        ]);

        try {
            Stripe::setApiKey(config('stripe.api_keys.secret_key'));

            // Create the Stripe plan
            $stripePlan = StripePlan::create([
                'amount' => $this->price * 100, // Amount in cents
                'currency' => 'usd', // Your currency
                'interval' => $this->interval, // 'month' or 'year'
                'product' => [
                    'name' => $this->plan_name,
                ],
            ]);

            // Create the plan in your database
            Plan::create([
                'name' => $this->plan_name,
                'price' => $this->price,
                'stripe_plan_id' => $stripePlan->id,
                'interval' => $this->interval,
                'credits' => $this->credits,
            ]);

            $this->dispatch('refresh');
            $this->close();

            $this->alert('success', __('Plan created successfully.',
                ['model' => __('models/Plan')]));

            // Reset the form after successful creation (optional).
            $this->reset(['plan_name', 'price']);

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.plans.create');
    }
}

<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Plan as StripePlan;
use Stripe\Product as StripeProduct;
use Stripe\Stripe;

class Edit extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $planId;

    public $plan_name;

    public $credits;

    public $price;

    public $interval;

    public $stripe_plan_id;

    #[On('open-edit-plan')]
    public function openModal(int $id): void
    {
        $plan = Plan::find($id);

        if (! $plan) {
            return;
        }

        $this->planId = $plan->id;
        $this->plan_name = $plan->name;
        $this->credits = $plan->credits;
        $this->price = $plan->price;
        $this->interval = $plan->interval;
        $this->stripe_plan_id = $plan->stripe_plan_id;
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['planId', 'plan_name', 'credits', 'price', 'interval', 'stripe_plan_id']);
    }

    public function save()
    {
        $this->validate([
            'plan_name' => ['required', 'string', 'max:255', Rule::unique('plans', 'name')->ignore($this->planId)],
            'price'     => ['required', 'numeric', 'min:1'],
            'credits'   => ['required', 'numeric', 'min:1'],
        ]);

        try {
            $plan = Plan::find($this->planId);

            if (! $plan) {
                $this->alert('error', 'Plan not found.');

                return;
            }

            Stripe::setApiKey(config('stripe.api_keys.secret_key'));

            $stripePlan = StripePlan::retrieve($plan->stripe_plan_id);

            // Always update the product name
            StripeProduct::update($stripePlan->product, ['name' => $this->plan_name]);

            $newStripePlanId = $plan->stripe_plan_id;

            // If price changed: create a new Stripe plan on the same product, delete the old one
            if ((float) $this->price !== (float) $plan->price) {
                $newStripePlan = StripePlan::create([
                    'amount'   => (int) ($this->price * 100),
                    'currency' => 'usd',
                    'interval' => $plan->interval,
                    'product'  => $stripePlan->product,
                ]);

                StripePlan::retrieve($plan->stripe_plan_id)->delete();

                $newStripePlanId = $newStripePlan->id;
            }

            $plan->update([
                'name'           => $this->plan_name,
                'price'          => $this->price,
                'credits'        => $this->credits,
                'stripe_plan_id' => $newStripePlanId,
            ]);

            $this->show = false;
            $this->reset(['planId', 'plan_name', 'credits', 'price', 'interval', 'stripe_plan_id']);

            $this->dispatch('refresh');
            $this->alert('success', 'Plan updated successfully.');

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.plans.edit');
    }
}

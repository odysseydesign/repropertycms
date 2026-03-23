<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Plan as StripePlan;
use Stripe\Product as StripeProduct;
use Stripe\Stripe;

#[On('refresh')]
class Index extends Component
{
    use LivewireAlert;

    public function deletePlan($id)
    {
        $plan = Plan::find($id);

        if (! $plan) {
            $this->alert('error', 'Plan not found.');

            return;
        }

        try {
            Stripe::setApiKey(config('stripe.api_keys.secret_key'));
            StripePlan::retrieve($plan->stripe_plan_id)->delete();
            $plan->delete();

            $this->alert('success', 'Plan deleted successfully.');
            $this->dispatch('refresh');

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function syncFromStripe()
    {
        try {
            Stripe::setApiKey(config('stripe.api_keys.secret_key'));

            $stripePlans = StripePlan::all(['limit' => 100]);
            $updated = 0;
            $created = 0;

            foreach ($stripePlans->data as $sp) {
                $product = StripeProduct::retrieve($sp->product);
                $interval = $sp->interval ?? 'month';
                $amount = ($sp->amount ?? 0) / 100;

                $local = Plan::where('stripe_plan_id', $sp->id)->first();

                if ($local) {
                    $local->update([
                        'name'     => $product->name,
                        'price'    => $amount,
                        'interval' => $interval,
                    ]);
                    $updated++;
                } else {
                    Plan::create([
                        'name'           => $product->name,
                        'price'          => $amount,
                        'stripe_plan_id' => $sp->id,
                        'interval'       => $interval,
                        'credits'        => 0,
                    ]);
                    $created++;
                }
            }

            $this->dispatch('refresh');
            $this->alert('success', "Sync complete: {$updated} updated, {$created} imported from Stripe.");

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        $plans = Plan::all();

        return view('livewire.admin.plans.index', ['plans' => $plans]);
    }
}

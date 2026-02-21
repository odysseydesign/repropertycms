<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Plan as StripePlan;
use Stripe\Stripe;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
class Index extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;

    public function deletePlan($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
                $plan = Plan::find($id);
                try {
                    Stripe::setApiKey(config('stripe.api_keys.secret_key'));
                    StripePlan::retrieve($plan->stripe_plan_id)->delete();

                    $plan->delete();

                    $this->alert('success', __('Plan deleted successfully.'));

                    $this->dispatch('refresh');

                } catch (\Exception $e) {

                    $this->alert('error', $e->getMessage());
                }
            },
            prompt: [
                'title' => __('Delete Plan'),
                'message' => __('Are you sure you want to delete this plan?'),
                'confirm' => __('Yes, Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );

        $this->dispatch('refresh');

    }

    public function render()
    {
        $plans = Plan::all();

        return view('livewire.admin.plans.index', ['plans' => $plans]);
    }
}

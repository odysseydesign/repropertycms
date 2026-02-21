<?php

namespace App\Livewire\Public;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class Subscribe extends Component
{
    use LivewireAlert;

    public $plans;

    public $agent;

    public function subscribeNow($planId)
    {
        // Get the currently authenticated user or redirect to login/register
        $this->agent = auth()->user();
        if (! $this->agent) {
            return redirect()->route('agent.login'); // Redirect to agent login
        }

        if ($this->agent->hasActiveSubscription()) {
            $this->alert('warning', 'You already have an active subscription.'); // Or redirect

            return; // Stop further processing
        }

        $plan = Plan::find($planId);

        try {
            $stripeCustomer = $this->agent->createOrGetStripeCustomer();

            Stripe::setApiKey(config('stripe.api_keys.secret_key'));

            $checkoutSession = Session::create([
                'success_url' => route('agent.payment_success').'?session_id={CHECKOUT_SESSION_ID}',
                // Redirect after success
                'cancel_url' => route('agent.payment_error'),
                // Redirect after cancellation
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $plan->stripe_plan_id,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
                'customer' => $stripeCustomer,
                'metadata' => [
                    'agent_id' => $this->agent->id,
                ],
            ]);

            return redirect($checkoutSession->url);
        } catch (ApiErrorException $e) {
            // Handle Stripe API errors
            $this->alert('error', 'Subscription failed: '.$e->getMessage());
        }
    }

    public function mount()
    {
        $this->plans = Plan::where('active', 1)->get();
    }

    public function render()
    {
        return view('livewire.public.subscribe');
    }
}

<?php

namespace App\Livewire\Agent;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use WireElements\Pro\Components\Modal\Modal;

class Plans extends Modal
{
    use LivewireAlert;

    public $agent;

    public $plans;

    public function save() {}

    public function subscribeNow($planId)
    {
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
                // 👇 Enable promo code field in Stripe Checkout
                'discounts' => $plan->name == 'Pilot' ? [
                    [
                        'promotion_code' => null, // user will input it manually in Checkout
                    ],
                ] : [],
                'allow_promotion_codes' => $plan->name == 'Pilot' ? true : false, // optional, older syntax
            ]);

            return redirect($checkoutSession->url);
        } catch (ApiErrorException $e) {
            // Handle Stripe API errors
            $this->alert('error', 'Subscription failed: '.$e->getMessage());
        }
        $this->close();
    }

    public function mount()
    {
        $this->agent = auth()->user();
        $this->plans = Plan::where('active', 1)->get();
    }

    public function render()
    {
        return view('livewire.agent.plans');
    }
}
<?php

namespace App\Livewire\Agent;

use App\Models\Properties;
use App\Models\Subscription;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class Billing extends Component
{
    use LivewireAlert;

    public $agent;

    public $subscriptions;

    public $portal = null;

    public $publishedPropertiesCount;

    public function subscriptionPlan()
    {
        return $this->dispatch('modal.open', component: 'agent.plans');
    }

    public function stripePortal()
    {
        $stripe = new StripeClient(config('stripe.api_keys.secret_key'));

        $stripeCustomer = $this->agent->createOrGetStripeCustomer();

        try {
            $response = $stripe->billingPortal->sessions->create([
                'customer' => $stripeCustomer->id,
                'return_url' => route('agent.billing'), // Redirect URL after portal session
            ]);

            $this->portal = $response->url;

            // Redirect the user to the portal URL
            return redirect($this->portal);

        } catch (ApiErrorException $e) {
            // Handle Stripe API errors
            $this->alert('error', 'Error generating portal session: '.$e->getMessage());

            // Optionally log the error for debugging
            \Log::error('Stripe API Error: '.$e->getMessage());
        }
    }

    public function mount()
    {
        $this->agent = auth()->user();
        $this->subscriptions = Subscription::where('agent_id', $this->agent->id)->get();
	    $this->publishedPropertiesCount = Properties::where('agent_id', $this->agent->id)->where('published', 1)->count();
    }

    public function render()
    {
        return view('livewire.agent.billing');
    }
}

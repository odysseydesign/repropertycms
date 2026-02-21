<?php

namespace App\Livewire\Agent;

use App\Models\Backend\Admin;
use App\Models\Plan;
use App\Models\Properties;
use App\Models\Subscription;
use App\Notifications\AdminPropertyPublished;
use App\Notifications\AgentPropertyPublished;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Notification;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use WireElements\Pro\Concerns\InteractsWithConfirmationModal;

#[On('refresh')]
class Dashboard extends Component
{
    use InteractsWithConfirmationModal;
    use LivewireAlert;
    public $agent;

    public $portal = null;

    public $property_descending_order;

    public $published_properties;

    public $property_update;

    public $subscriptions;

    public $publishedPropertiesCount;

    public $subscriptionAlert;

    public function publishProperty($id)
    {
        $property = Properties::find($id);
        $activeSubscription = $this->agent->hasActiveSubscription();

        if ($activeSubscription) {
            $plan = Plan::where('stripe_plan_id', $this->agent->activeSubscription->stripe_price)->first();
            if ($plan) {
                $publishedPropertiesCount = Properties::where('agent_id', $this->agent->id)->where('published', 1)->count();
                if ($plan->credits > $publishedPropertiesCount) {
                    $this->askForConfirmation(
                        callback: function () use ($property) {
                            $property->update([
                                'published' => true,
                                'reviewed' => true,
                                'publish_date' => Carbon::now(),
                            ]);

                            $this->alert('success', 'Property published successfully!', [
                                'toast' => true,
                            ]);

                            // send notification to agent
                            //                            $this->agent->notify(new AgentPropertyPublished($property));

                            // send notification to all admins
                            $admins = Admin::get();
                            //							Notification::send($admins, new AdminPropertyPublished($property));

                            $this->dispatch('refresh');
                        },
                        prompt: [
                            'title' => __('Publish Property'),
                            'message' => __('Do you really want to Publish this property?'),
                            'confirm' => __('Publish'),
                            'cancel' => __('Stop'),
                        ],
                        modalAttributes: [
                            'size' => '2xl',
                        ]
                    );
                } else {
                    $this->alert('error', 'You already have used full credit. To Publish more property, please Upgrade your plan.', [
                        'toast' => true,
                    ]);
                    //                return $this->dispatch('modal.open', component: 'agent.upgrade');
                }

                return;

            } else {
                $this->alert('error', 'No Plan Found!', [
                    'toast' => true,
                ]);
            }
        }

        return $this->dispatch('modal.open', component: 'agent.plans');
    }

    public function deleteProperty($id)
    {
        $this->askForConfirmation(
            callback: function () use ($id) {
                $property = Properties::find($id);
                $property->delete();

                $this->alert('success', 'Property deleted successfully!', [
                    'toast' => true,
                ]);
                $this->dispatch('refresh');
            },
            prompt: [
                'title' => __('Delete Property'),
                'message' => __('Do you really want to delete this property?'),
                'confirm' => __('Delete'),
                'cancel' => __('Stop'),
            ],
            modalAttributes: [
                'size' => '2xl',
            ]
        );
    }

    public function stripePortal()
    {
        $stripe = new StripeClient(config('stripe.api_keys.secret_key'));

        $stripeCustomer = $this->agent->createOrGetStripeCustomer();

        try {
            $response = $stripe->billingPortal->sessions->create([
                'customer' => $stripeCustomer->id,
                'return_url' => route('agent.dashboard'), // Redirect URL after portal session
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
            // Check subscription status and set alert array for the view using a separate method
            $this->getSubscriptionAlert();
        $this->publishedPropertiesCount = Properties::where('agent_id', $this->agent->id)->where('published', 1)->count();
    }

    public function render()
    {
        $this->published_properties = $this->agent->properties()->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->with('state') // Eager load the state relationship
            ->get();

        $this->property_descending_order = $this->agent->properties()
            ->orderBy('id', 'desc')
            ->limit(5)
            ->with('state') // Eager load the state relationship
            ->get();

        $this->property_update = $this->agent->properties()->where('published', 0)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('livewire.agent.dashboard');
    }

    private function formatPropertyAddress(Properties $property)
    {
        $addressParts = array_filter([
            $property->address_line_1,
            $property->city,
            $property->zip,
        ]);

        return implode(', ', $addressParts);
    }
    public function subscriptionPlan()
    {
        return $this->dispatch('modal.open', component: 'agent.plans');
    }
    
    public function getSubscriptionAlert()
    {
        $subscription = Subscription::where('agent_id', $this->agent->id)
            ->orderByDesc('created_at')
            ->first();


        // Check subscription status and set alert array for the view
        $this->subscriptionAlert = null;

        if ($subscription) {
            $now = \Carbon\Carbon::now();
            if ($subscription->current_period_end) {
                $currentPeriodEnd = Carbon::parse($subscription->current_period_end);

                // Check if subscription expires in 5 days
                if ($currentPeriodEnd->greaterThan($now) && $now->diffInDays($currentPeriodEnd) <= 5) {
                    $this->subscriptionAlert = [
                        'alert_message' => "Your subscription will expire in " . intval($now->diffInDays($currentPeriodEnd)) . " days. Your subscription will renew automatically, but if it does not (for example, due to a payment issue), all your properties will be unpublished.",
                        'alert_color' => "#ffe5b4",
                        'alert_foreground_color' => "#ff8c00",
                        'alert_icon' => '<i class="fa fa-exclamation-triangle text-warning"></i>',
                        'alert_section' => 'Subscription Expiring Soon',
                    ];
                }

                // Check if subscription already expired
                if ($currentPeriodEnd->lessThan($now)) {
                    $this->subscriptionAlert = [
                        'alert_message' => "Your subscription has expired. All your properties have been unpublished. Please renew your subscription.",
                        'alert_color' => "#ffe5e5",
                        'alert_foreground_color' => "#b71c1c",
                    'alert_icon' => '<i class="fa fa-exclamation-circle text-danger"></i>',
                    'alert_section' => 'Subscription Expired',
                    ];
                }
            }
        }
    }
}

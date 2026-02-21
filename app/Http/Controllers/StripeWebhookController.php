<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Plan;
use App\Models\Subscription;
use App\Notifications\AdminSubscriptionExpired;
use App\Notifications\AdminSubscriptionNotification;
use App\Notifications\AdminSubscriptionRenewed;
use App\Notifications\AgentSubscriptionExpired;
use App\Notifications\AgentSubscriptionRenewed;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Mail;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    /*
     * Stripe Customer Webhooks
     * */
    public function receiveWebhook(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));
        $endpoint_secret = config('stripe.api_keys.webhook_secret');
        // Log the raw payload
        $payload = @file_get_contents('php://input');
        Log::info('Stripe Webhook Received:', ['payload' => $payload]);

        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? null;
        if (!$sig_header) {
            Log::error('Stripe Webhook Error: Missing signature header');
            return response()->json(['error' => 'Missing Stripe signature'], 400);
        }

        $event = null;

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
            Log::info('Stripe Webhook Parsed Successfully', ['event_type' => $event->type]);
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe Webhook Error: Invalid payload', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe Webhook Error: Invalid signature', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                Log::info('Handling checkout.session.completed', ['session_id' => $session->id]);
                $this->handleCheckoutSessionCompleted($session);
                break;

            case 'customer.subscription.created':
                $subscription = $event->data->object;
                Log::info('Handling customer.subscription.created', ['subscription_id' => $subscription->id]);
                $this->handleSubscriptionCreated($subscription);
                break;

            case 'customer.subscription.updated':
                $subscription = $event->data->object;
                Log::info('Handling customer.subscription.updated', ['subscription_id' => $subscription->id]);
                $this->handleSubscriptionUpdated($subscription);
                break;

            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                Log::info('Handling customer.subscription.deleted', ['subscription_id' => $subscription->id]);
                $this->handleSubscriptionDeleted($subscription);
                break;

            default:
                Log::warning('Received unknown event type', ['event_type' => $event->type]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function handleCheckoutSessionCompleted($session) {}

    protected function handleSubscriptionCreated($subscription)
    {
        $agent = Agents::where('customer_id', $subscription->customer)->first();

        if ($agent) {
            Subscription::create([
                'agent_id' => $agent->id,
                'name' => $subscription->metadata->plan,
                'stripe_id' => $subscription->id,
                'stripe_status' => $subscription->status,
                'stripe_price' => $subscription->items->data[0]->price->id,
                'quantity' => $subscription->quantity,
                'start_date' => date('Y-m-d H:i:s', $subscription->start_date),
                'current_period_end' => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            // send subscription welcome notification to agent

            $agent->notify(new \App\Notifications\SubscriptionWelcome($agent));

            Notification::route('mail', 'email@riemailtask.com') // or use an admin model here.
            ->notify(new AdminSubscriptionNotification($agent));
        }

    }

    protected function handleSubscriptionUpdated($subscription)
    {
        $sub = Subscription::where('stripe_id', $subscription->id)->first();

        if ($sub) {
            $sub->stripe_status = $subscription->status;
            $sub->current_period_end = date('Y-m-d H:i:s', $subscription->current_period_end);
            $sub->quantity = $subscription->quantity;
            $sub->stripe_price = $subscription->plan->id;
            $sub->save();

            if ($subscription->status === 'active') { // Check renewal
                $agent = Agents::where('customer_id', $subscription->customer)->first();

                if ($agent) {
                    // Get the count of published properties
                    $published_properties = $agent->totalPublishedPropertiesCount;

                    // Get the active subscription credits
                    $activeSubscription = $agent->activeSubscription;
                    $activePlanCredits = $activeSubscription->plan->credits;

                    Log::info('Agent Subscription Check', [
                        'agent_id' => $agent->id,
                        'published_properties' => $published_properties,
                        'activeSubscription' => $activeSubscription,
                        'activePlanCredits' => $activePlanCredits

                    ]);

                    if ($published_properties > $activePlanCredits) {
                        $unpublishPropertiesCount = $published_properties - $activePlanCredits;

                        Log::info('Unpublishing Properties', [
                            'agent_id' => $agent->id,
                            'unpublishPropertiesCount' => $unpublishPropertiesCount
                        ]);

                        if ($agent->email !== 'ra@odysseydesign.us') {
                            $agent->publishedProperties()
                                ->orderBy('publish_date', 'desc') // Get recently published properties first
                                ->limit($unpublishPropertiesCount)
                                ->update(['published' => false]); // Unpublish properties
                        }
                    }
                    $agent->notify(new AgentSubscriptionRenewed($subscription, $agent));

                    Notification::route('mail', 'email@riemailtask.com') // or use an admin model here.
                    ->notify(new AdminSubscriptionRenewed($agent));
                }
            }
        }
    }

    protected function handleSubscriptionDeleted($subscription)
    {

        $sub = Subscription::where('stripe_id', $subscription->id)->first();

        if ($sub) {
            $sub->stripe_status = $subscription->status;
            $sub->ends_at = date('Y-m-d H:i:s', $subscription->ended_at);
            $sub->save();

            $agent = Agents::where('customer_id', $subscription->customer)->first();
            if ($agent) {
                $agent->notify(new AgentSubscriptionExpired($subscription)); // Assuming you have a notification for this

                $publishedProperties = $agent->publishedProperties()->delete();

                Notification::route('mail', 'email@riemailtask.com') // or use an admin model here.
                ->notify(new AgentSubscriptionExpired($agent));
            }
        }
    }

    private function handleSubscription($subscription)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('stripe.api_keys.secret_key'));

            $customer = $stripe->customers->retrieve(
                $subscription->customer,
                []
            );

            try {
                $agent = Agents::where('email', $customer->email)->firstOrFail();
                $agent->customer_id = $subscription->customer;
                $agent->save();

                echo $agent->id.' updated with customer id '.$subscription->customer;
            } catch (\Exception $ex) {
                echo $ex->getMessage();

                $splitName = explode(' ', $customer->name, 2);
                $password = base64_encode($customer->email);
                $agent = new Agents;
                $agent->first_name = $splitName[0];
                $agent->last_name = ! empty($splitName[1]) ? $splitName[1] : '';
                $agent->email = $customer->email;
                $agent->password = Hash::make($password);
                $agent->customer_id = $subscription->customer;
                $agent->save();

                echo $agent->id.' created with customer id '.$subscription->customer;

                // send email to new customer
                $name = $customer->name;
                $email = $customer->email;
                $data = ['name' => $name, 'email' => $email, 'password' => $password];
                $user['to'] = $email;
                Mail::send('mail.stripe-registered', $data, function ($message) use ($user) {
                    $message->to($user['to'])
                        ->cc(['email@riemailtask.com'])
                        ->subject('Welcome to Realty Interface');
                });
            }

            $user_subscription = Subscription::updateOrCreate([
                'subscription_id' => $subscription->id,
            ], [
                'agent_id' => $agent->id,
                'customer_id' => $subscription->customer,
                'billing' => $subscription->billing,
                'billing_cycle_anchor' => $subscription->billing_cycle_anchor ? Carbon::createFromTimestamp($subscription->billing_cycle_anchor)->format('Y-m-d H:i:s') : null,
                'start_date' => $subscription->start_date ? Carbon::createFromTimestamp($subscription->start_date)->format('Y-m-d H:i:s') : null,
                'cancel_at' => $subscription->cancel_at ? Carbon::createFromTimestamp($subscription->cancel_at)->format('Y-m-d H:i:s') : null,
                'cancel_at_period_end' => $subscription->cancel_at_period_end,
                'canceled_at' => $subscription->canceled_at ? Carbon::createFromTimestamp($subscription->canceled_at)->format('Y-m-d H:i:s') : null,
                'created' => $subscription->created ? Carbon::createFromTimestamp($subscription->created)->format('Y-m-d H:i:s') : null,
                'current_period_end' => $subscription->current_period_end ? Carbon::createFromTimestamp($subscription->current_period_end)->format('Y-m-d H:i:s') : null,
                'current_period_start' => $subscription->current_period_start ? Carbon::createFromTimestamp($subscription->current_period_start)->format('Y-m-d H:i:s') : null,
                'ended_at' => $subscription->ended_at ? Carbon::createFromTimestamp($subscription->ended_at)->format('Y-m-d H:i:s') : null,
                'default_payment_method' => $subscription->default_payment_method,
                'price_id' => $subscription->plan->id,
                'amount' => $subscription->plan->amount,
                'interval' => $subscription->plan->interval,
                'interval_count' => $subscription->plan->interval_count,
                'product' => $subscription->plan->product,
                'quantity' => $subscription->quantity,
                'status' => $subscription->status,
            ]);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    private function handleInvoice($invoice) {}

    private function handleSubscriptionSchedule($subscriptionSchedule) {}
}

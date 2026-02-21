<?php

namespace App\Traits;

use Stripe\Customer;
use Stripe\Stripe;

trait ManagesStripeCustomers
{
    public function createOrGetStripeCustomer()
    {
        Stripe::setApiKey(config('stripe.api_keys.secret_key'));

        if ($this->customer_id) {
            try {
                return Customer::retrieve($this->customer_id);
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Handle the case where the customer might have been deleted in Stripe
                if (strpos($e->getMessage(), 'No such customer') !== false) {
                    $customer = Customer::create([
                        'email' => $this->email,
                        'name' => $this->first_name.' '.$this->last_name,
                        'metadata' => [
                            'agent_id' => $this->id,
                        ],
                    ]);
                    $this->update(['customer_id' => $customer->id]);

                    return $customer;
                }
                // Handle other Stripe exceptions as needed
                throw $e;
            }
        }

        $customer = Customer::create([
            'email' => $this->email,
            'name' => $this->first_name.' '.$this->last_name,
            'metadata' => [
                'user_id' => $this->id,
            ],
        ]);

        $this->update(['customer_id' => $customer->id]);

        return $customer;
    }
}

<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Plan;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentsController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        $agent = session('agent');

        $session_id = $request->get('session_id');

        if (! $session_id) {
            // Handle missing session_id (e.g., redirect with error message)
            return redirect()->route('agent.billing')->with('error', 'Invalid session ID. Payment may have failed.');
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $session = Session::retrieve($session_id);
            // Check session status and other relevant details here before updating the database.
            if ($session->payment_status === 'paid') {

                return view('agent.payment.success');

            } else {
                return redirect()->route('agent.billing')->with('error', 'Payment failed.'); // Example
            }

        } catch (\Exception $e) {
            // Handle exceptions (e.g., invalid session ID)
            return redirect()->route('agent.billing')->with('error', 'An error occurred during payment processing.'); // Example
        }
    }

    public function paymentError(Request $request)
    {
        return view('agent.agents.payment_error');
    }

    public function payment(Request $request)
    {
        $agent = session('agent');
        $plan = Plan::where('id', '=', $request['id'])->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));

        $session = \Stripe\Checkout\Session::create([

            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',

                        'product_data' => [
                            'name' => $plan->name,
                        ],
                        'unit_amount' => $plan->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('agent/payment-success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('agent/payment-error'),
        ]);
        $payment = new Payments;
        $payment->agent_id = $agent->id;
        $payment->plan_id = $plan->id;
        $payment->payment_id = $session->id;
        $payment->amount = $plan->price;
        $payment->currency = 'USD';
        if ($payment->save()) {

            // Add Code in payments migration tabel and migrate the table
            return Redirect($session->url)->with($request['id']);
        } else {
            return redirect()->back()->with('error', 'Payment Failed ! ');
        }

    }
}

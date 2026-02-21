<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function showSubscriptionPage()
    {
        // Display the subscription plan details on a public page
        return view('public.subscribe'); // Create this view
    }
}

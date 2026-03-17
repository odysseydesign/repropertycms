<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    public function index() {
	    return view('admin.subscriber.index');
    }
}

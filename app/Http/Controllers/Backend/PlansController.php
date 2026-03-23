<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    public function index()
    {
        return view('admin.plans.index');
    }
}

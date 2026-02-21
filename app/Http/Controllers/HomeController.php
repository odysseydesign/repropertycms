<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @return Factory|View|Application
     */
    public function termsAndConditions()
    {
        return view('site.terms-and-conditons');
    }
}

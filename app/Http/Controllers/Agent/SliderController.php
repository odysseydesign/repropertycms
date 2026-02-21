<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Properties;

class SliderController extends Controller
{
    public function index()
    {
        $property = session('property');

        if (! $property || ! $property->id) {
            return $property
                ? view('agent.slider.index')
                : redirect('agent/property/listing')->with('error', 'You cannot access Property Slider directly!');
        }

        $property = Properties::findOrFail($property->id);

        return view('agent.slider.index', ['property' => $property]);
    }
}

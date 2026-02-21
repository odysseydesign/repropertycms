@extends('layouts.agents.default1')

@section('title', 'Property Sliders | ' . $property?->name)

@section('content')

    @livewire('agent.slider.index', ['property' => $property])
@endsection
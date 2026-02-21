@extends('layouts.agents.default1')
@section('title', 'Property Floorplans | ' . $property?->name)

@section('content')
    @livewire('floorplan', ['property' => $property])
@stop
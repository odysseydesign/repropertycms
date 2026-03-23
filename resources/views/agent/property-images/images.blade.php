@extends('layouts.agents.default1')

@section('title', 'Property Images | ' . $property?->name)

@section('content')
    @livewire('photo-library.index', ['property' => $property])
    @livewire('photo-library.add-new-image')
@stop
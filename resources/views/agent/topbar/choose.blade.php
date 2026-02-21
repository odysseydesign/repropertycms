@extends('layouts.agents.default1')

@section('title', 'Property | ' . $property?->name)

@section('content')
    @livewire('agent.topbar.choose', ['property' => $property])
@endsection
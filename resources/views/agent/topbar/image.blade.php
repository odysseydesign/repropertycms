@extends('layouts.agents.default1')

@section('title', 'Image Header | ' . $property?->name)

@section('content')
    @livewire('agent.topbar.choose', ['property' => $property])
@endsection
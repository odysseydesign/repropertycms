@extends('layouts.agents.default1')

@section('title', 'Video Header | ' . $property?->name)

@section('content')
    @livewire('agent.topbar.video', ['property' => $property])
    @livewire('video.add')
    @livewire('video.view')
@endsection
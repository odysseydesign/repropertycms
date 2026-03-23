@extends('layouts.agents.default1')

@section('title', 'Property Videos | ' . $property?->name)

@section('content')
    @livewire('video.index', ['property' => $property])
    @livewire('video.add')
    @livewire('video.view')
@stop
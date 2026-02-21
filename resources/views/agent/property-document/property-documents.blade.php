@extends('layouts.agents.default1')

@section('title', 'Property Documents | ' . $property?->name)

@section('content')
    @livewire('agent.document.index', ['property' => $property])
@stop
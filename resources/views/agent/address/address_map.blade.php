@extends('layouts.agents.default1')

@section('title', 'Address & Map | ' . $property?->name)

@section('content')
    @livewire('map.index', ['property' => $property])
@stop

@push('scripts')
    <script>

    </script>
@endpush
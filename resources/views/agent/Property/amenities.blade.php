@extends('layouts.agents.default1')

@section('title', 'Amenity | ' . $property?->name)


@section('content')
    @php
        if(isset($property)){
                $data =  $property->id;
                $agent_id = $property->agent_id;
            }
            else{
                $data = "";
                $id = '';
            }
    @endphp

    <div class="w-full rounded">
        @livewire('amenity.index', ['property' => $property])
    </div>
    @livewire('add-new-amenity')
@stop
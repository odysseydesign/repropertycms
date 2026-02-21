@extends('layouts.agents.default1')

@section('title', 'Delete Property | ' . $property?->name)

@section('content')
{{--    @livewire('map.index', ['property' => $property])--}}
    <div class="w-full px-28 py-10">
        <h3>Delete Property</h3>
        <div class="text-center bg-light px-28 py-10">
{{--            <i class="fa-solid fa-check text-9xl"></i>--}}
            <p class="text-red-600 font-bold text-2xl">
                Deleting this property will permanently delete the website
                <strong class="font-bold">"{{ $property->address_line_1 }}"</strong> of all photos and information included with this property.
            </p>
            <br/>
            <p class="text-red-600 font-bold text-2xl">
                You may create another property to replace this one based on your active subscription.
            </p>
            <br/><br/><br/><br/>
            <a href="{{url('agent/property/delete/'. $property->id )}}" class="btn bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-5 text-lg focus:outline-none focus:shadow-outline">
                Confirm Deletion
            </a>
            <a href="{{route('agent.dashboard')}}" class="text-primary ml-10 text-2xl underline font-bold">Cancel</a>
        </div>
    </div>

@stop

@push('scripts')
    <script>

    </script>
@endpush
@props([
	'property'
])
@php
$color = '#0069a6';
@endphp
<div class="container mb-5">
    <div class="d-flex align-items-center mb-3">
        <p class="ml-4 font-bold text-lg" style="color: #4b4b4b">
            <i class="fa fa-home mr-2" style="color: grey"></i> Properties
        </p>
        <span class="badge border ml-5 px-2 rounded-sm shadow-lg bg-light" style="min-width: 20px; font-weight: 500; font-size: 0.875rem; border-color: #d5d4d4">
            {{ $property->count() }}
        </span>
    </div>


    <div class="d-flex flex-wrap gap-3 mb-5" style="display: flex; flex-wrap: wrap; gap: 15px;">
        @if ($property->count() > 0)
            @foreach($property as $row)
                <div style="width: calc(25% - 15px); min-width: 250px;" class="text-center">
                    <div class="card shadow-lg mb-4" style="width: 300px; height: 350px;">
                        <div class="card-body align-items-center p-2">
                            <div style="width: 100%; height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if($row->property_images->first())
                                    <img src="{{ asset_s3($row->property_images->first()->thumb) }}" class="card-img-top" alt="Property Image" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/bedrealtyinterface5.jpg') }}" class="card-img-top" alt="Property Image" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <h5 class="card-title text-center mt-3" style="color: #0b0b0b;">{{ $row->address_line_1 }}</h5>
                        </div>
                    </div>

                    <div class="mt-2">
                        @if(!$row->published)
                            <button wire:click="publishProperty({{ $row->id }})" class="ml-10 text-lg mt-2" style="color: {{ $color }};">
                                Publish Property
                            </button><br>
                            <button wire:click="deleteProperty({{ $row->id }})" class="ml-10 text-lg mt-3 mb-4" style="color: {{ $color }};">
                                Delete Property
                            </button><br>
                        @endif
                        <a href="{{ url('agent/property/address/' . $row->id) }}" class="ml-10 text-lg" style="display: inline-block; margin-bottom: 13px !important; color: {{ $color }};">
                            Edit Property
                        </a><br>
                        <a href="{{ url($row->unique_url) }}" target="_blank" class="ml-10 text-lg" style="display: inline-block; margin-bottom: 10px !important; color: {{ $color }};">
                            Preview Property
                        </a><br>
                        @if(!$row->published)
                            <a href="{{ url('share/' . $row->unique_url) }}" target="_blank" class="ml-10 text-lg" style="display: inline-block; margin-bottom: 10px !important; color: {{ $color }};">
                                Share Unpublished Property
                            </a><br>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No Properties Found.</p>
        @endif
    </div>
</div>

{{--<div class="table-responsive">--}}
{{--    <table class="table w-full table-striped table-auto mb-5">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Property Name</th>--}}
{{--            <th>City, State</th>--}}
{{--            <th class="text-center">Price</th>--}}
{{--            <th class="text-center">Count Of Images</th>--}}
{{--            <th class="text-center">Count Of Floor Plans</th>--}}
{{--            <th class="text-center">Views</th>--}}
{{--            <th class="text-center">Created</th>--}}
{{--            <th class="text-center">Published</th>--}}
{{--            <th class="text-center">Actions</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        @if ($property->count() > 0)--}}
{{--            @foreach( $property as $row)--}}
{{--                <tr>--}}
{{--                    <td>{{$row->name}}</td>--}}
{{--                    <td>{{ $row->city }}, {{ $row->state?->name }}</td>--}}
{{--                    <td class="text-right">{{$row->price}}</td>--}}
{{--                    <td class="text-center">{{$row->property_images->count()}}</td>--}}
{{--                    <td class="text-center">{{$row->property_floorplans->count()}}</td>--}}
{{--                    <td class="text-center">{{$row->views}}</td>--}}
{{--                    <td class="text-center">{{ $row->created_at->format('d M Y') }}</td>--}}
{{--                    <td class="text-center">--}}
{{--                        {{($row->published == 1) ? "Yes" : "No"}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <a href="{{url('agent/property/address/' . $row['id'])}}"--}}
{{--                               class="button button-blue button-sm my-1" title="Edit Property">--}}
{{--                                <i class="fa fa-pencil mr-1"></i>--}}
{{--                            </a>--}}
{{--                            @if(!$row->published)--}}
{{--                                <a href="{{url($row['unique_url'])}}" target="_blank"--}}
{{--                                   class="button button-blue button-sm my-1" title="Property Preview">--}}
{{--                                    <i class="fa fa-eye mr-1"></i>--}}
{{--                                </a>--}}

{{--                                <button wire:click="publishProperty({{ $row->id }})"--}}
{{--                                        class="button button-blue button-sm my-1" title="Publish Property">--}}
{{--                                    <i class="fa fa-upload mr-1"></i>--}}
{{--                                </button>--}}
{{--                            @else--}}
{{--                                <a target="_blank" href="{{url($row->unique_url)}}"--}}
{{--                                   class="button button-blue button-sm my-1" title="Property Example">--}}
{{--                                    <i class="fa fa-globe mr-1"></i>--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                            <button wire:click="deleteProperty({{ $row->id }})"--}}
{{--                                    class="button button-blue button-sm my-1" title="Delete Property">--}}
{{--                                <i class="fa fa-times mr-1"></i>--}}
{{--                            </button>--}}
{{--                            <a href="https://realtyinterface.com/learn" target="_blank"--}}
{{--                               class="button button-blue button-sm my-1" title="Build Website Tutorial">--}}
{{--                                <i class="fa fa-external-link mr-1"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @else--}}
{{--            <tr>--}}
{{--                <td colspan="9">No Properties Found.</td>--}}
{{--            </tr>--}}
{{--        @endif--}}
{{--    </table>--}}
{{--</div>--}}
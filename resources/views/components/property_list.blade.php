@props([
	'property'
])
@php
$color = '#0069a6';
@endphp
<div class="container mb-5" x-data="{ confirmDeleteId: null }">
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
                                    <img src="{{ asset('images/placeholder-chalet-exterior.jpg') }}" class="card-img-top" alt="Property Image" style="width: 100%; height: 100%; object-fit: cover;">
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
                            <button type="button" @click="confirmDeleteId = {{ $row->id }}" class="ml-10 text-lg mt-3 mb-4" style="color: {{ $color }};">
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

    {{-- Delete Confirmation Overlay --}}
    <div x-show="confirmDeleteId !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="confirmDeleteId = null"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Delete Property</h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to delete this property? This action cannot be undone.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="confirmDeleteId = null" class="button button-grey">Cancel</button>
                    <button type="button" @click="$wire.doDeleteProperty(confirmDeleteId); confirmDeleteId = null" class="button button-red">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Publish Confirmation Overlay (triggered from PHP via confirmPublishId) --}}
    <div x-show="$wire.confirmPublishId !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="$wire.cancelConfirmPublish()"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Publish Property</h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to publish this property? It will be visible to the public.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="$wire.cancelConfirmPublish()" class="button button-grey">Cancel</button>
                    <button type="button" @click="$wire.doPublishProperty()" class="button button-green">Publish</button>
                </div>
            </div>
        </div>
    </div>
</div>

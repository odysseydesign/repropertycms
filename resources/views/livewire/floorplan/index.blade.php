<div>
    <div class="FloorPlan_wrap">
        <div class='content'>
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">Upload Floor Plans here</h5>
            </div>
            <!-- Dropzone -->
            <form action="{{url('agent/property/save-floorplans')}}" method="POST" class='dropzone floorplan_drop'>
                @method('GET')
                <input type="hidden" name="property_id" id="property_id" value="{{ $property['id'] }}">
                <div class="float-right pt-14 mt-1 mr-16 progress-bar">
                    <progress id="progressbar" value="0" max="100" class="progressbar hidden"></progress>
                    <p class="inline-block pt-10 pl-10 size">0 b</p>
                    <p class="inline-block pl-5 percentage">0</p>%
                </div>
            </form>
        </div>
        <div class="my-5 d-flex justify-content-end rs-mb-1 rs-button-full">
            <a href="{{route('agent.property_document.index')}}"
               class="button button-blue button-outlined font-bold text-base mb-0 mr-2"><i
                        class="fa fa-arrow-left mr-2"></i> Prev</a>
            <a href="{{url('agent/address/address-map')}}" class="button button-blue font-bold text-base mb-0">Next
                <i class="fa fa-arrow-right ml-2"></i></a>
        </div>
        @if($property_floorplans->count() > 0)
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">Uploaded Property Floor Plans</h5>
            </div>
        @endif

        <ul class="floorplan-form mt-5" wire:sortable="updateOrder">
            @foreach ($property_floorplans as $property_floor)
                <li class="col-md-6" wire:sortable.item="{{ $property_floor->id }}" wire:key="floorplan-{{ $property_floor->id }}">
                    <div class="flex my-3 card gallery-image" id="floorplan_block{{ $property_floor->id }}">
                        <div class="w-100 py-8 px-5 inline-block relative ">
                            <div class="img">
                                <a wire:navigate.prevent href="{{ url('agent/property-floorplan/add-hotspot/' . $property_floor->id) }}"
                                   onclick="event.stopPropagation();">
                                    <img src="{{asset_s3($property_floor->thumb)}}" alt="reload">
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="d-inline-block" id="fileName{{ $property_floor->id }}"
                                    contenteditable="true"
                                    onblur="changeFloorPlanImageName('{{ $property_floor->id }}',<?= $property_floor->id ?>)"
                                    title="Edit Your file name">{{ $property_floor->name }}</h5>
                                <i class="fa fa-pencil"
                                   onclick="FloorplanImageEditName('{{ $property_floor->id }}')"
                                   style="font-size: 16px; cursor:pointer; color: #0069a6;"></i>
                                <button title="Delete Floor Plan"
                                        class="rounded-md text-xl text-red-500 border border-transparent py-2 px-4 text-center transition-all"
                                        type="button"
                                        wire:click="deleteFloorplan({{ $property_floor->id }})"
                                        data-ripple-light="true"><i class="fa fa-times"></i>
                                </button>
                                <p class="my-1">Total No. of hotspots: {{ $property_floor->hotspots()->count() }}</p>
                            </div>
                            <!-- Drag Handle -->
                            <div wire:sortable.handle style="cursor: grab;">
                                <i class="fa fa-bars"></i> <i class="ml-2">Drag from here to Reorder</i>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

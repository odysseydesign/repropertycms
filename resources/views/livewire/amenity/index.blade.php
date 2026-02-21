<form wire:submit="save" id="amenitesForm" method="post">
    @csrf
    <div class="w-full">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Property Amenities</h5>
            <a href="#" onclick="Livewire.dispatch('modal.open', {component: 'add-new-amenity'})" class="btn-blue m-0">
                <i class="fa fa-plus mr-1"></i> Add New Amenity
            </a>
        </div>
        <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap page-heading">
                <h5 class="mb-0">Amenities :</h5>
                <a href="javascript:void(0);" class="float-right px-2 text-base" wire:click="deleteAmenities()">Clear
                    All</a>
            </div>
            <div id="addAmenities" name="amenities"
                 class="addAmenities h-44 p-2 border border-grey-500 overflow-scroll background-color">

                @foreach($property_amenities as $amenity)
                    <div id="{{$amenity->amenity_id}}" class="amenitie">
                        <input type="text" disabled="disabled"
                               value="{{ isset($amenity->Amenities) ? $amenity->Amenities->name : $amenity->name }}"
                               class="amenitiesbutton">
                        <a href="javascript:void(0);" style="cursor:pointer"
                           class="amenities_close"
                           wire:click="removeAmenity({{ $amenity->amenity_id }})">&times;</a>
                    </div>
                @endforeach
                @foreach($custom_amenities as $custom_amenity)
                    <div class="amenitie">
                        <input type="text" disabled="disabled"
                               value="{{ $custom_amenity }}"
                               class="amenitiesbutton">
                        <a href="javascript:void(0);" style="cursor:pointer"
                           class="amenities_close"
                           wire:click="removeCustomAmenity('{{ $custom_amenity }}')">&times;</a>
                    </div>
                @endforeach
            </div>
            <input type="hidden" id="amenities_array" name="amenities_array"
                   value="{{ implode(',',$amenities_array) }}">
        </div>
        <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg"
             id="amenitie_suggation">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap page-heading">
                <h5 class="mb-0">Click an amenity below to add to your amenities list :</h5>
            </div>
            <div class="p-2 border border-grey-500 amenitieData background-color">
                @foreach($amenities as $amenity)
                    @if(count($amenities_array) > 0 )
                        @if(!in_array( $amenity->id,$amenities_array))
                            <span id="{{$amenity->id}}" name="{{$amenity->name}}" class="amenities"
                                  wire:click="addAmenity({{$amenity->id}})"
                            >{{$amenity->name}}</span>
                        @endif
                    @else
                        <span id="{{$amenity->id}}" name="{{$amenity->name}}" class="amenities"
                              wire:click="addAmenity({{$amenity->id}})"
                        >{{$amenity->name}}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{url('agent/property/description')}}"
           class="button button-outlined button-blue font-bold text-base mb-0 mt-5 justify-content-end"><i
                    class="fa fa-arrow-left mr-2"></i> Prev</a>
        <button type="submit" id="amenitiesForm"
                class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                data-ripple-light="true"> Save & Next <i class="fa fa-arrow-right ml-2"></i></button>
    </div>
</form>
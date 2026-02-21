<div>
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Image Header</h5>
        <a href="#"
           onclick="Livewire.dispatch('modal.open', {component: 'agent.topbar.image', arguments: { 'property': {{ $property->id }} } })"
           class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Add Banner Image
        </a>
    </div>
    <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
        @if($property_image)
            <div class="views-form mt-5 property_image">
                <div class="inline-block h-52 w-52 mx-3 relative gallery-image" id="1">
                    <div class="w-52 h-52 pb-0  inline-block relative gallery-image">
                        <div class="border-b border-grey-300">

                            <img src="{{asset_s3($property_image->thumb ?? 1)}}" id="image{{$property_image->id}}"
                                 class="card-image-style"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="views-form mt-5">
                <div class="p-5" style="border:1px solid #eee; border-radius:6px;">
                    <div class="py-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="cursor-pointer form-check-input" id="property_header"
                                   wire:model.live="property_header" {{ $property_header ? 'checked' : '' }}>
                            <label for="property_header" class="form-check-label pl-1">
                                Set this Image as Property Header
                            </label>
                        </div>
                        @if($property_header)
                            <div class="autoplay-notes">
                                <b>Please note: </b>this Image is set as Property Header.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <p class="text-center mt-5">You've no Image set as Cover. Please set one from here. <a
                        class="button button-outlined button-amber m-0" href="#"
                        onclick="Livewire.dispatch('modal.open', {component: 'agent.topbar.image', arguments: { 'property': {{ $property->id }} } })">Select
                    Image</a></p>
        @endif
    </div>
    <div class="d-flex justify-content-end mt-5 rs-mb-1 rs-button-full">
        <a href="{{ url('agent/property-topbar/slider') }}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-2">
            <i class="fa fa-arrow-left mr-2"></i> Prev
        </a>
        <a href="{{ route('agent.video.3d-tour') }}" class="button button-blue font-bold text-base mb-0">
            Next <i class="fa fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>
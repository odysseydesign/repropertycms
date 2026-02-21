<div>
    <div class="image_gallery_wrap mt-4">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Property Images</h5>
            <a href="#"
               onclick="Livewire.dispatch('modal.open', {component: 'photo-library.add-new-image', arguments: { 'property': {{ $property->id }} } })"
               class="btn-blue m-0">
                <i class="fa fa-plus mr-1"></i> Add New Images
            </a>
        </div>
        <div class="views-form mt-5 property_image">
            @foreach($property_images as $property_image)
                <div class="inline-block h-52 w-52 mx-3 relative gallery-image" id="{{$property_image->id}}">
                    <div style="height:10.5rem;" class="relative border-b border-grey-300">
                        <img src="{{asset_s3($property_image->thumb ?? null)}}" id="image{{$property_image->id}}"
                             class="card-image-style" alt="">
                    </div>
                    <a href="#" title="Rotate Image" onclick="rotateImage({{ $property_image->id }});"><i
                                class="fa fa-rotate mr-5 ml-2 mt-3 text-green-500"></i></a>

                    <a href="#" title="Delete Image" class="float-right"
                       wire:click="deleteImage({{ $property_image->id }})"><i
                                class="fa fa-times mr-5 ml-2 mt-3 text-red-600"></i></a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="property-next d-flex justify-content-end rs-button-full">
        <a href="{{url('agent/property/price-feature')}}"
           class="button button-blue button-outlined font-bold text-base mb-0 mt-2 mr-2 justify-content-end"><i
                    class="fa fa-arrow-left mr-2"></i> Prev</a>
        <a href="{{url('agent/galleries/gallery-images')}}"
           class="button button-blue font-bold text-base mb-0 mt-2 justify-content-end">Next <i
                    class="fa fa-arrow-right ml-2"></i> </a>
    </div>

    <div class="h-full w-full absolute top-0 left-0 hidden image-rotate-wrap">
        <div class="border-2 bg-white img-modal text-center is-filled p-5">
            <div class="top-5 text-6xl close-modal">
                <a class="float-right" style="cursor: pointer;" onclick="closeRotateImage()"><i
                            class="far fa-times-circle"></i></a>
            </div>
            <div class="mt-5">
                <h2 class="">Rotate Image</h2>
            </div>
            <div class="text-center">
                <a class="button button-orange" onClick="leftRotateImg()" data-ripple-light="true"><i
                            class="fas fa-undo mr-2"></i>Left Rotate</a>
                <a class="button button-orange" onClick="rightRotateImg()" data-ripple-light="true"><i
                            class="fas fa-redo-alt mr-2"></i>right Rotate</a>
            </div>
            <div class="w-full m-auto text-center flex justify-center">
                <div class="mt-5 mb-5 h-2/4 w-1/2  m-auto text-center flex justify-center img-rotate-box">
                    <img src="" name="rotate_img" id="rotate_img" alt=""
                         style="width: auto; max-width: 300px;max-height: 300px;">
                </div>
            </div>
            <input type="hidden" value="0" id="direction">
            <input type="hidden" value="0" id="rotate_id">
            <div class="text-center">
                <button class="button button-green rotateImg" onclick="saveImageRotate()" data-ripple-light="true">Save
                    And Close
                </button>
            </div>
        </div>
    </div>
</div>
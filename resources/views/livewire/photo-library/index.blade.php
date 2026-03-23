<div x-data="{ confirmId: null }">
    <div class="image_gallery_wrap mt-4">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
            <h5 class="mb-0">Property Images</h5>
            <a href="#"
               onclick="Livewire.dispatch('open-photo-add', { propertyId: {{ $property->id }} })"
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
                       @click.prevent="confirmId = {{ $property_image->id }}"><i
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

    {{-- Delete Confirmation Overlay --}}
    <div x-show="confirmId !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="confirmId = null"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Delete Image</h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to delete this image? This action cannot be undone.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="confirmId = null" class="button button-grey">Cancel</button>
                    <button type="button" @click="$wire.doDeleteImage(confirmId); confirmId = null" class="button button-red">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

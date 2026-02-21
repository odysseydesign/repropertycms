<div class="w-full">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Property Slider</h5>
        <p>Drag up to 7 images from the right to left to create your slideshow.</p>
    </div>
    <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
        <div class="d-flex align-items-center justify-content-between my-4 flex-wrap">
            <div class="float-left w-3/5 overflow-auto px-2">
                <div class="h-auto overflow-auto" id="gallery">
                    <form action="" method="post">
                        <div class="border-1 gallery_body p-3 border-grey-300 h-96 overflow-auto relative form-control d-flex"
                             id="Drop_Box">
                            @if($property_slider->count() > 0)
                                @foreach( $property_slider as $property_slide)
                                    <div class="inline-block w-full h-52 relative border border-grey-300"
                                         wire:key="{{ $property_slide->image_id }}"
                                         data-image-id="{{ $property_slide->image_id }}"
                                         id="{{$property_slide->image_id}}">
                                        <img src="{{asset_s3($property_slide->property_images->thumb)}}"
                                             id="{{$property_slide['image_id']}}" draggable="true"
                                             class="card-image-style" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a href="#" class="button button-green mt-5" id="saveimageslider" onclick="saveImageSlider()">Save
                            Slider</a>
                    </form>
                </div>
            </div>

            <div class="w-2/5 float-right h-screen overflow-auto px-2 h-100">
                @if($property_images->count() > 0)
                    <div class="border drag-box border-2 border-grey-400 grid grid-cols-2 sticky-gallery" id="Drag_Box"
                         style="height: 384px;overflow-y: auto;">
                        @foreach($property_images as $property_image)
                            <div class="inline-block relative h-52 w-60 border border-grey-300 m-2 gallery-img-box choose-gallery"
                                 wire:key="{{ $property_image->image_id }}"
                                 data-image-id="{{ $property_image->image_id }}"
                                 id="{{$property_image->id}}">
                                <img src="{{asset_s3($property_image->thumb ?? 1)}}" id="{{$property_image->id}}"
                                     draggable="true"
                                     class=" card-image-style" alt="">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No image found to add in Gallery. Please click on the 'Photo Library' link and add images.</p>
                @endif
            </div>
        </div>

        <div class="views-form mt-5">
            <div class="p-5" style="border:1px solid #eee; border-radius:6px;">
                <div class="py-3">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="cursor-pointer form-check-input" id="property_header"
                               wire:model.live="property_header" {{ $property_header ? 'checked' : '' }}>
                        <label for="property_header" class="form-check-label pl-1">
                            Set this Slider as Property Header
                        </label>
                    </div>
                    @if($property_header)
                        <div class="autoplay-notes">
                            <b>Please note: </b>this Slider is set as Property Header.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-5 rs-mb-1 rs-button-full">
        <a href="{{ url('agent/property-topbar/video') }}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-2">
            <i class="fa fa-arrow-left mr-2"></i> Prev
        </a>
        <a href="{{ url('agent/property-topbar/image') }}" class="button button-blue font-bold text-base mb-0">
            Next <i class="fa fa-arrow-right ml-2"></i>
        </a>
    </div>
    <script>
        // Drag the image grid
        $(function () {
            DropBox = document.getElementById('Drop_Box'),
                new Sortable(DropBox, {
                    group: 'shared',
                    animation: 150,
                });

            //Drag box
            DragBox = document.getElementById('Drag_Box'),
                new Sortable(DragBox, {
                    group: 'shared',
                    animation: 150
                });
        });
    </script>
</div>
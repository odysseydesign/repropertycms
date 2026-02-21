@extends('layouts.agents.default1')

@section('title', 'Photo Galleries')

@section('content')
    @php
        $gallery_count = 1;
    @endphp

    <script>
        var gallery_count = {{ $gallery_count }};

        // Drag the image grid
        $(function () {

            @if(count($property_gallery) > 0)
                    @foreach($property_gallery_details as $pg)
                DropBox = document.getElementById('Drop_Box' + gallery_count),
                new Sortable(DropBox, {
                    group: 'shared', // set both lists to same group
                    animation: 150
                });
            gallery_count++;
            @endforeach
                    @else
                DropBox = document.getElementById('Drop_Box1'),
                new Sortable(DropBox, {
                    group: 'shared',
                    animation: 150
                });
            gallery_count++;
            @endif

            //Drag box
            DragBox = document.getElementById('Drag_Box'),
                new Sortable(DragBox, {
                    group: 'shared',
                    animation: 150
                });

        });
        if (document.getElementById("choice-search")) {
            var element = document.getElementById("choice-search");
            const example = new Choices(element, {
                searchEnabled: false,
            });
        }
    </script>
    <div class="align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Photo Galleries</h5>
        <p class="m-0" style="font-size: 15px">
            
            <h6 style="text-transform: none;">
                <strong>Note:</strong> The first image in the gallery will be used as the main display image.  
                <em>You can drag images to reorder them.</em>
              </h6>
            <i>Expand your window to Full Size.</i>
        </p>
    </div>
    <div class="w-full pb-2 h-screen gallery_body main-content p-0  my-4 flex-wrap page-heading" id="gallery_body">
        <div class="float-left w-3/5 overflow-auto gallery h-100 p-0 form-bg">
            <div class="h-auto overflow-auto" id="gallery">
                @if($property_gallery->count() > 0)
                    @foreach($property_gallery_details as $key=> $property_detail)
                        <form action="" method="post" id="saveimagegallery{{ $gallery_count }}">
                            <div class="input-group input-group-outline mt-3 mb-3">
                                <span>Gallery Name :</span>
                                <input type="text" name="gallery_name" style="border:2px solid lightgrey" placeholder=""
                                       maxlength="100" value="{{ $property_detail['gallery_name'] }}"
                                       id="gallery_name{{ $gallery_count }}" class="form-control"/>
                            </div>

                            <div class="input-group input-group-outline mt-3 mb-3 @if(isset( $property_detail['short_description'] )) is-filled @endif">
                                <span>Short Description : (255 Characters Allowed Max)</span>
                                <textarea id="short_description{{ $gallery_count }}" name="short_description"
                                          maxlength="255" class="form-control" rows="4"
                                          placeholder="">{{ $property_detail['short_description'] }}</textarea>
                            </div>
                            <div class="border-1 border-grey-300 h-96 overflow-auto relative form-control grid-auto"
                                 id="Drop_Box{{ $gallery_count }}">
                                @foreach( $property_detail['images'] as $property_images_detial)
                                    <div class="inline-block w-40 h-40 relative border border-grey-300 m-2"
                                         id="{{$property_images_detial['property_image_id']}}">
                                            <img src="{{asset_s3($property_images_detial['thumb_name'])}}"
                                                 id="{{$property_images_detial['property_image_id']}}" draggable="true"
                                                 class="card-image-style" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" value="1" id="sequence" name="sequence"/>
                            <input type="hidden" id="gallery_id{{ $gallery_count }}" value="{{ $key }}">
                            <div class="d-flex align-items-center justify-content-start rs-button-full mb-0">
                                <a href="#" class="button button-green my-2 mb-0 mr-3"
                                   id="saveimagegallery{{ $gallery_count }}"
                                   onclick="saveImageGallery({{ $gallery_count }})">Save Gallery{{$gallery_count}}</a>
                                @if($property_gallery->count() > 1)
                                    <a href="#" id="deleteimagegallery({{ $gallery_count }})"
                                       class="button button-green my-2 mb-0 deleteimagegallery"
                                       onclick="deleteImagegallery({{ $gallery_count }}, {{ $key }})">delete{{$gallery_count}}</a>
                                @endif
                            </div>
                        </form>
                        @php $gallery_count++ @endphp
                    @endforeach
                @else
                    <form action="" method="post" id="saveimagegallery{{ $gallery_count }}">

                        <div class="input-group input-group-outline mt-3 mb-3">
                            <span>Gallery Name :</span>
                            <input name="gallery_name" id="gallery_name1" maxlength="100" value="Gallery 1"
                                   class="form-control"/>
                        </div>
                        <div class="input-group input-group-outline mt-3 mb-3">
                            <span>Short Description : (255 Characters Allowed Max)</span>
                            <textarea id="short_description1" maxlength="255" name="short_description"  rows="4"
                                      class="form-control" placeholder=""></textarea>
                        </div>
                        <div class="border h-96 overflow-auto" id="Drop_Box1">
                        </div>
                        <input type="hidden" value="1" id="sequence" name="sequence"/>
                        <input type="hidden" id="gallery_id1" value="0">
                        <a href="#" class="button button-green mt-1" onclick="saveImageGallery(1);"
                           data-ripple-light="true">Save Gallery 1</a>
                    </form>
                @endif
            </div>
            <br>
            <input class="GalleryCount" type="hidden" value="{{ $gallery_count }}">
            <div class="d-flex align-items-center justify-content-start rs-button-full mb-0">
                @if($property_gallery->count() > 0)
                    <a href="#" class="button button-pink float-right" onclick="addGallery({{ $key }});"
                       data-ripple-light="true">Add New Gallery</a>
                @endif
            </div>
            <div class="d-flex justify-content-end rs-button-full mb-0">
                <a href="{{url('agent/property-images/images')}}"
                   class="button button-blue button-outlined font-bold text-base mb-0 mr-3"><i
                            class="fa fa-arrow-left mr-2"></i> Prev</a>
                <a href="{{url('agent/video/video')}}"
                   class="button button-blue font-bold text-base mb-0">Next <i class="fa fa-arrow-right ml-2"></i> </a>
            </div>
        </div>

        <div class="w-2/5 float-right h-screen overflow-auto p-0 h-100 form-bg">
            @if($property_images->count() > 0)
                <div class="border-2 border-grey-400 grid grid-cols-2 sticky-gallery responsive-gallery" id="Drag_Box"
                     style="min-height: 400px;">
                    @foreach($property_images as $property_image)
                        <div class="inline-block relative h-40 w-60 border border-grey-300 m-2 gallery-img-box"
                             id="{{$property_image->id}}">
                                <img src="{{asset_s3($property_image->thumb ?? 1)}}" id="{{$property_image->id}}"
                                     class="card-image-style" alt="">

                        </div>
                    @endforeach
                </div>
            @else
                No image found to add in Gallery. Please click on the 'Photo Library' link and add images.
            @endif
        </div>
    </div>
@stop
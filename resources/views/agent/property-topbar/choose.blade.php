@extends('layouts.agents.default1')

@section('title', 'Top Bar | ' . $property?->name)

@section('content')

    <script>

        // Drag the image grid
        $(function () {

            DropBox = document.getElementById('Drop_Box'),
                new Sortable(DropBox, {
                    group: 'shared',
                    animation: 150
                });

            //Drag box
            DragBox = document.getElementById('Drag_Box'),
                new Sortable(DragBox, {
                    group: 'shared',
                    animation: 150
                });

        });
    </script>

    <div class="nav-tabs w-full py-5">
        <nav>
            <ul role="tablist" class="tabs p-1" tab-panel="">
                <li class="nav-item">
                    <a class="nav-link active mb-0 px-0 py-1 bg-transparent-color" aria-selected="true"
                       aria-controls="Image" role="tab">Images</a>
                </li>
                <li class="nav-item">
                    <a
                            class="nav-link mb-0 px-0 py-1 bg-transparent-color" aria-selected="false"
                            aria-controls="Slider" role="tab">Slider</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 bg-transparent-color" aria-selected="false" aria-controls="video"
                       role="tab">Videos</a>
                </li>
            </ul>
        </nav>
        <div class="tabs-content mt-5">
            <div class="active tab-panel bg-transparent-color w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg"
                 id="Image" role="tabpanel">
                <div class="d-flex align-items-center justify-content-between my-4 mt-0 flex-wrap page-heading">
                    <h5 class="mb-0">Property Images</h5>
                </div>
                <div class="views-form mt-5 property_image">
                    @foreach($property_images as $property_image)
                        <div class="inline mr-3" id="{{$property_image->id}}">
                            <div class="w-52 h-52 pb-0  inline-block relative gallery-image">
                                <div style="height:10rem;" class="relative  border-b border-grey-300">
                                    <img src="{{asset_s3($property_image->thumb)}}" id="image{{$property_image->id}}"
                                         class="card-image-style" alt="">

                                </div>
                                <div class="w-full p-3 text-center">
                                    @if($propertie->featured_image != $property_image->id)
                                        <a href="#" id="featureimage" class=" m-5 featureimage" title="Feature image"
                                           onclick="saveFeatureImage('{{ $property_image->id }}',this)">Select Image</a>

                                        <a href="#" class="m-5 text-green-900 font-bold currentimage hidden">Current
                                            Image</a>
                                    @else
                                        <a href="#" class="m-5 text-green-900 font-bold currentimage" id="currentimage">Current
                                            Image</a>

                                        <a href="#" title="Feature image" class="m-5 featureimage hidden"
                                           onclick="saveFeatureImage('{{ $property_image->id }}',this)">Select Image</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($propertie->main_section == 'Image')
                    <a class="button button-grey mt-1 float-right saveforimage" disabled> Selected for Property</a>
                @else
                    <a href="#" class="button button-green mt-1 float-right saveforimage" data-subject="image"
                       onclick="saveForProperty(this)">Select for property</a>
                @endif

            </div>

            <div class="tab-panel bg-transparent-color w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg"
                 id="Slider" role="tabpanel">
                <div class="d-flex align-items-center justify-content-between my-4 mt-0 flex-wrap page-heading">
                    <h5 class="mb-0">Property Slider</h5>
                </div>
                <div class="w-full pb-2 row">
                    <div class="float-left w-3/5 overflow-auto px-2">
                        <div class="h-auto overflow-auto" id="gallery">
                            <form action="" method="post">
                                <div class="border-1 gallery_body p-3 border-grey-300 h-96 overflow-auto relative form-control d-flex"
                                     id="Drop_Box">
                                    @if($property_slider->count() > 0)
                                        @foreach( $property_slider as $property_slide)
                                            <div class="inline-block w-full h-52 relative border border-grey-300"
                                                 id="{{$property_slide->image_id}}">
                                                <img src="{{asset_s3($property_slide->property_images->thumb)}}"
                                                     id="{{$property_slide['image_id']}}" draggable="true"
                                                     class="card-image-style" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <a href="#" class="button button-green mt-5" id="saveimageslider"
                                   onclick="saveImageSlider()">Save Slider</a>
                            </form>
                        </div>
                    </div>

                    <div class="w-2/5 float-right h-screen overflow-auto px-2 h-100">
                        @php
                            if($property_images->count() > 0) {
                        @endphp

                        <div class="border drag-box border-2 border-grey-400 grid grid-cols-2 sticky-gallery"
                             id="Drag_Box" style="height: 384px;overflow-y: auto;">
                            @foreach($property_images as $property_image)
                                <div class="inline-block relative h-52 w-60 border border-grey-300 m-2 gallery-img-box choose-gallery"
                                     id="{{$property_image->id}}">
                                    <img src="{{asset_s3($property_image->thumb)}}" id="{{$property_image->id}}"
                                         draggable="true" class=" card-image-style" alt="">
                                </div>
                            @endforeach
                        </div>

                        @php
                            } else {
                                echo "No image found to add in Gallery. Please click on the 'Photo Library' link and add images.";
                            }
                        @endphp
                    </div>
                </div>
                @if($propertie->main_section == 'Slider')
                    <div class="pl-2">
                        <a class="button button-green mt-5 saveforslider" disabled> Selected for Property</a>
                    </div>
                @else
                    <div class="pl-2">
                        <a href="#" class="button button-green mt-5 saveforslider" data-subject="slider"
                           onclick="saveForProperty(this)"> Select for Property</a>
                    </div>
                @endif
            </div>


            <div class="tab-panel bg-transparent-color w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg"
                 id="video" role="tabpanel">
                <div class="d-flex align-items-center justify-content-between my-4 mt-0 flex-wrap page-heading">
                    <h5 class="mb-0">Property Videos</h5>
                </div>
                <div class="views-form mt-5 property_videos">
                    @foreach($property_videos as $property_video)
                        <div class="inline mr-3" id="{{$property_video->id}}">
                            <div class="w-auto pb-0  inline-block relative gallery-image"
                                 name="{{ $property_video->video_type}}">
                                @if(is_null($property_video->video_url))
                                    <video width="285" height="100%" controls>
                                        <source src="{{asset('files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                                type="video/mp4">
                                        <source src="{{asset('files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                                type="video/ogg"/>
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <x-embed url="{{ $property_video->video_url }}"/>
                                @endif
                                @if($property_video->featured != 1)
                                    <div class="card-body">
                                        <a href="#" title="Featured video" class="mx-0 featuredvideo" id="featuredvideo"
                                           onclick="featureVideo('{{ $property_video->id }}',this)">Feature video</a>

                                        <a href="#" class="mx-0 text-green-900 font-bold currentvideo hidden">Current
                                            Video</a>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <a href="#" class="mx-0 text-green-900 font-bold currentvideo"
                                           id="currentvideo">Current Video</a>
                                        <a href="#" title="Featured video" class="mx-0 featuredvideo hidden"
                                           onclick="featureVideo('{{ $property_video->id }}>',this)">Feature video</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($propertie->main_section == 'Video')
                    <a class="button button-grey mt-1 float-right saveforvideo" disabled> Selected for Property</a>
                @else
                    <a href="#" class="button button-green mt-1 float-right saveforvideo" data-subject="video"
                       onclick="saveForProperty(this)">Select for property</a>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{route('agent.floorplan.index')}}"
               class="button button-blue button-outlined font-bold text-base mb-0 mt-5 justify-content-end mr-2"><i
                        class="fa fa-arrow-left mr-2"></i> Prev</a>
            <a href="{{url('agent/address/address-map')}}"
               class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end">Next <i
                        class="fa fa-arrow-right ml-2"></i> </a>
        </div>
    </div>
@stop
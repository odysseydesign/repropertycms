@extends('layouts.agents.default1')
@section('title', 'Hotspot New')

@section('content')
    <link rel="stylesheet" href="{{asset('plugins/pushy.min.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('plugins/cropper.min.css')}}">--}}

    {{--    <link rel="stylesheet" href="{{asset('plugins/photoswipe.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/default-skin.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/chardinjs.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/protip.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/dropzone.min.css')}}">--}}
    {{--    <link rel="stylesheet"--}}
    {{--          href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/evol-colorpicker.min.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('plugins/bootstrap-tourist.css')}}">--}}
    <link rel="stylesheet" href="{{asset('plugins/useradmin.css')}}">
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        $.widget.bridge('uibutton', $.ui.button);--}}
    {{--        $.widget.bridge('uitooltip', $.ui.tooltip);--}}
    {{--        var sidenavCondensed = true;--}}
    {{--    </script>--}}
    {{--    <script src="https://apis.google.com/js/platform.js')}}" async defer></script>--}}
    {{--    <script src="{{asset('plugins/all.min.js')}}"></script>--}}
    <script src="{{asset('plugins/bootstrap.bundle.min.js')}}"></script>
    {{--    <script src="{{asset('plugins/plugins-bundle.min.js')}}"></script>--}}
    {{--    <script src="{{asset('plugins/jquery.serializejson.js')}}"></script>--}}
    {{--    <script src="{{asset('plugins/bootstrap-tourist.js')}}"></script>--}}
    {{--    <script src="{{asset('plugins/qrcode.min.js')}}"></script>--}}
    {{--    <script src="{{asset('plugins/useradmin.js')}}"></script>--}}

    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            var $selected_property = $(".property-d43827d6ad85943e6681");--}}
    {{--            if ($selected_property) {--}}
    {{--                $("#menuWebsites .list-group").prepend($selected_property);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}

    <div class="flex mt-5">
        <div class="w-full">
            <div class="w-full">
                <a href="{{route('agent.floorplan.index')}}"
                   class="button button-blue button-outlined font-bold text-base mb-0 mt-2 mr-2 justify-content-end"><i
                            class="fa fa-arrow-left mr-2"></i> Go to
                    Floor Plans</a>
            </div>
            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                <h5 class="mb-0">{{ $property_floorplans->name}}</h5>
            </div>
            <div class="flex">
                <div class="w-full drop-append relative">
                    <div class="fp-editor pb-4">
                        <div class="fp-container">
                            <div class="fp-image">
                                <img src="{{asset_s3($property_floorplans->file_name)}}" class="img-web"
                                     style="width:100%;height:auto;"
                                     data-src="{{asset_s3($property_floorplans->file_name)}}">

                                @foreach($property_floorplans->hotspots as $hotspot)
                                    <div class='photo-box' data-html='true' data-sanitize='false'
                                         data-areaid='{{ $hotspot->id }}'
                                         data-photo-assets='{{ $hotspot->propertyImages()->pluck('hotspot_property_images.property_images_id')->join(',') }}'
                                         data-title='' data-toggle='popover' data-content=''
                                         data-placement='top'
                                         style="top:{{ $hotspot->top }}%; left:{{ $hotspot->left }}%; width:{{ $hotspot->width }}%; height:{{ $hotspot->height }}%">
                                        <div class='remove-box' data-toggle='popover' data-content='Remove hotspot area'
                                             data-placement='top'>x
                                        </div>
                                        <div class='ml-auto num-photos'>{{ $hotspot->propertyImages()->count() }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <canvas id="fp-canvas" class="border"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .pushy {
            width: 250px;
            background-color: #fff;
            opacity: 1;
        }

        .pushy-left {
            -webkit-transform: translate3d(-250px, 0, 0);
            -ms-transform: translate3d(-250px, 0, 0);
            transform: translate3d(-250px, 0, 0);
        }

        .pushy-open-left #admin-container, .pushy-open-left .push {
            -webkit-transform: translate3d(250px, 0, 0);
            -ms-transform: translate3d(250px, 0, 0);
            transform: translate3d(250px, 0, 0);
        }
    </style>
    <nav class="pushy pushy-left pushy-floor-plans border-right shadow">
        <div class="pushy-content">
            <div class="d-flex align-items-center pt-1">
                <div class="h5 pl-3 text-555 pt-1">
                    Link Photos
                </div>
                <div class="ml-auto mr-2">
                    <span class="close-photo-menu cursor-pointer text-gray-800" style="font-size:1.4em;"><i
                                class="fas fa-times"></i></span>
                </div>
            </div>
            <div class="py-2 px-3 text-555 font-90">
                Click on image(s) to assign it to your floor plan.
            </div>
            <div class="photo-scroller text-center">
                @foreach($property_images as $property_image)
                    <div class="inline-table relative h-40 w-52 m-2">
                        <div class="d-inline-block m-1 cursor-pointer select-photo photo-{{ $property_image->id }}"
                             data-assetid="{{ $property_image->id }}" data-thumb="{{$property_image->thumb}}">
                            <div class="text-center" style="position:absolute; top:0px; right:5px;">
                                <input type="checkbox" name="photo_asset" class="" value="1">
                            </div>
                            <img src="{{asset_s3($property_image->thumb)}}" class="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </nav>
    <div class="site-overlay"></div>
    <script src="{{asset('plugins/pushy.js')}}"></script>
    <script>
        var mediapkid = {{ $property_floorplans->id }};
    </script>
    <script src="{{asset('plugins/floor-plans-edit.js')}}"></script>
@endsection
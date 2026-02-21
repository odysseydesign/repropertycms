@extends('layouts.agents.default1')

@section('title', 'Price & Features | ' . $property?->name)

@section('content')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    @php
        if(isset($property)){
                $levels = $property->levels;
                $levels_image = $property->levels_image;
                $bedroom = $property->bedroom;
                $bedroom_image = $property->bedroom_image;
                $bathroom = $property->bathroom;
                $bathroom_image = $property->bathroom_image;
                $stories = $property->stories;
                $garage = $property->garage;
                $parking_spaces = $property->parking_spaces;
                $price = $property->price;
                $price = $property->price;
                $property_area = $property->property_area;
            }
            else{
                $id = '';
                $levels = old('levels');
                $levels_image = old('levels_image');
                $bedroom = old('bedroom') ;
                $bedroom_image = old('bedroom_image');
                $bathroom = old('bathroom');
                $bathroom_image = old('bathroom_image');
                $stories = old('stories');
                $garage = old('garage');
                $parking_spaces = old('parking_spaces');
                $price = old('price') ;
                $property_area = old('property_area') ;
            }
    @endphp

    <div class="w-full rounded">
        <form action="{{url('agent/property/store-priceFeature')}}" id="amenitesForm" method="post">
            @csrf
            <div class="w-full">
                <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                    <h5 class="mb-0">Price & Features</h5>
                </div>
                <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg min-height-auto">
{{--                    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">--}}
{{--                        <h5 class="mb-0">Price & Property Size</h5>--}}
{{--                    </div>--}}
                    <div class="flex-row wrap box-2">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline">
                                <span>Display Price :</span>
                                <input type="text" id="price" style="border:2px solid lightgrey;" placeholder=""
                                       name="price" value="{{ $price }}" class="form-control"/>
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline">
                                <span>Property Area (in sq. ft): </span>
                                <input type="text" id="property_area" style="border:2px solid lightgrey;" placeholder=""
                                       name="property_area" value="{{ $property_area }}" class="form-control"/>
                                @error('property_area') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row wrap box-2">
                    <div class="col-md-6">
                        <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
                            <span>Levels :</span>
                            <div class="input-group input-group-outline">
                                <select class="form-control" name="levels" id="levels">
                                    <option value="0" selected disabled>-None-</option>
                                    <option value="1" {{ $levels == '1' ? 'selected' : '' }}>One</option>
                                    <option value="2" {{  $levels == '2' ? 'selected' : ''  }}>Two</option>
                                    <option value="3" {{  $levels == '3' ? 'selected' : ''  }}>Three</option>
                                    <option value="4" {{  $levels == '4' ? 'selected' : ''  }}>Fourth</option>
                                </select>
                            </div>
                            @if(is_string($property->levels_image))
                                <img src="{{asset_s3($property->levels_image)}}" alt="" class="w-36 my-2">
                            @endif
                            <input type="file" style="border:2px solid lightgrey;" data-subject='crop-levels_img-img'
                                   name="levels_img" class="form-control w-full mt-3 px-2 image"/>
                            <input type="hidden" name="crop_levels_img_image" id="crop_levels_img_image"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
                            <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                                <h5 class="mb-0">Beds & Baths</h5>
                            </div>
                            <div class="flex responsive-row">
                                <div class="w-1/2 mx-1 w-50">
                                    <div class="input-group input-group-outline">
                                        <span>Bedrooms</span>
                                        <input type="text" style="border:2px solid lightgrey;" placeholder=""
                                               id="bedroom" name="bedroom" value="{{$bedroom}}" class="form-control"/>
                                        @error('bedroom') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    @if(is_string($bedroom_image))
                                        <img src="{{asset_s3($bedroom_image)}}" alt="" class="w-36 my-2">
                                    @endif
                                    <input type="file" style="border:2px solid lightgrey;"
                                           data-subject='crop-bedroom-img' name="bedroom_img"
                                           class="form-control w-full mt-3 px-2 image"/>
                                    <input type="hidden" name="crop_bedroom_image" id="crop_bedroom_image"/>
                                </div>
                                <div class="w-1/2 mx-1 w-50">
                                    <div class="input-group input-group-outline">
                                        <span>Bathrooms : </span>
                                        <input type="text" style="border:2px solid lightgrey;" placeholder=""
                                               id="bathroom" name="bathroom" value="{{$bathroom}}"
                                               class="form-control"/>
                                        @error('bathroom') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    @if(!is_null($bathroom_image) && !empty($bathroom_image))
                                        <img src="{{asset_s3($bathroom_image)}}" alt="" class="w-36 my-2">
                                    @endif
                                    <input type="file" style="border:2px solid lightgrey;"
                                           data-subject='crop-bathroom-img' name="bathroom_img"
                                           class="form-control w-full mt-3 px-2 image"/>
                                    <input type="hidden" name="crop_bathroom_image" id="crop_bathroom_image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" pb-5 w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
                    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                        <h5 class="mb-0">ADDITIONAL</h5>
                    </div>
                    <div class="flex-row wrap box-2">
                        <div class="col-md-4">
                            <div class="input-group input-group-outline mb-4">
                                <span>Stories :</span>
                                <input type="text" id="stories" style="border:2px solid lightgrey;" placeholder=""
                                       name="stories" value="{{$stories}}" class="form-control"/>
                                @error('stories') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-outline mb-4">
                                <span>Garage : </span>
                                <input type="text" style="border:2px solid lightgrey;" placeholder="" id="garage"
                                       name="garage" value="{{$garage}}" class="form-control"/>
                                @error('garage') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-outline">
                                <span>Parking Spaces :</span>
                                <input type="text" style="border:2px solid lightgrey;" placeholder=""
                                       id="parking_spaces" name="parking_spaces" value="{{ $parking_spaces }}"
                                       class="form-control"/>
                                @error('parking_spaces') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end rs-button-full">
                <a href="{{url('agent/property/amenities')}}"
                   class="button button-outlined button-blue font-bold text-base mb-0 mt-5 justify-content-end"><i
                            class="fa fa-arrow-left mr-2"></i> Prev</a>
                <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                        data-ripple-light="true">save & next <i class="fa fa-arrow-right ml-2"></i></button>
            </div>
        </form>
        <div class="w-1/2 text-left">
            <button class="button button-pink hidden crop-img-btn" id="crop-img-btn" dialog-trigger="true"
                    data-ripple-light="true">
                Demo dialog
            </button>
            <div class="dialog">
                <div class="dialog-overlay" dialog-close="true"></div>
                <div class="modal-dialog" style="max-width: 1000px !important;" id="modal">
                    <div class="dialog-content">
                        <div class="dialog-header">
                            <h6 class="mb-0">Crop Image Before Upload</h6>
                            <button type="button" class="me-0 button-close" dialog-close="true" data-dismiss="modal"
                                    aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="dialog-body">
                            <div class="img-container">
                                <div class="w-100">
                                    <div class="w-8/12">
                                        <img id="image" style="display: block;max-width: 100%;"
                                             src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="w-2/6">
                                        <div class="preview w-40 h-40 m-3 text-center overflow-hidden border border-grey"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dialog-footer">
                            <button class="button button-gradient button-dark mr-3 mb-0" data-dismiss="modal"
                                    dialog-close="true">
                                Cancel
                            </button>
                            <button class="button button-gradient button-pink mb-0 crop" dialog-close="true"
                                    data-dismiss="modal" aria-label="Close" id="crop">
                                Crop
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.image').on("change", function () {
                $('input').removeClass('click');
                $(this).addClass('click');
            });
// add image crop code for js
            var data = document.getElementsByClassName('click');
            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", ".image", function (e) {

                var done = function (url) {
                    image.src = url;
                    $("#crop-img-btn").trigger("click");
                    $modal.modal('show');
                };

                var file;
                var files = e.target.files;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        var reader;
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $(".crop").click(function (e) {
                canvas = cropper.getCroppedCanvas({
                    width: 821,
                    height: 461.8125,
                });
                canvas.toBlob(function (blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;
                        if (data[0].dataset.subject == 'crop-levels_img-img') {
                            $("#crop_levels_img_image").val(base64data);
                        } else if (data[0].dataset.subject == "crop-bedroom-img") {
                            $("#crop_bedroom_image").val(base64data);
                        } else {
                            $("#crop_bathroom_image").val(base64data);
                        }
                    }
                });
            });

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 1.778,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

        });
    </script>
@stop
@extends('layouts.agents.default1')

@section('title', 'Description | ' . $property->name)

@section('content')
    @php
        if(isset($property)){
            $description = $property->description;
            $headline = $property->headline;
            $video_credit = $property->video_credit;
            $photographer_credit = $property->photographer_credit;
        }
        else{
            $description = old('description');
            $headline = old('headline');
            $video_credit = old('video_credit');
            $photographer_credit = old('photographer_credit');
        }
    @endphp

    <div class="w-full rounded">
        <form action="{{url('agent/property/store-description')}}" id="amenitesForm" method="post">
            @csrf
            <div class="w-full">
                <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                    <h5 class="mb-0">Property Details</h5>
                </div>
                <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
                    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
                        <h5 class="mb-0">Description :</h5>
                    </div>
                    <div class="mt-0">
                        <span class="text-2xl"></span>
                        <div class=" mt-4">
                            <div class="input-group input-group-outline">
                                <span>Headline (200 characters max):</span>
                                <input type="text" style="border:2px solid lightgrey;" placeholder="" id="headline"
                                       maxlength="200" name="headline" value="{{$headline}}" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-0">
                        <span class="text-2xl"></span>
                        <div class=" mt-4">
                            <span>Description :</span>
                            <textarea id="description" name="description"
                                      class="summernote">{{ $description }}</textarea>
                        </div>
                    </div>
                    <div class="flex-row wrap box-2">
                        <div class="col-md-6">
                            <div class="mt-0">
                                <span class="text-2xl"></span>
                                <div class=" mt-4">
                                    <div class="input-group input-group-outline">
                                        <span>Video Credit:</span>
                                        <input type="text" style="border:2px solid lightgrey;" placeholder=""
                                               id="headline" maxlength="200" name="video_credit"
                                               value="{{$video_credit}}" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-0">
                                <span class="text-2xl"></span>
                                <div class=" mt-4">
                                    <div class="input-group input-group-outline">
                                        <span>Photographer Credit:</span>
                                        <input type="text" style="border:2px solid lightgrey;" placeholder=""
                                               id="photographer_credit" maxlength="200" name="photographer_credit"
                                               value="{{$photographer_credit}}" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end rs-button-full">
                <a href="{{url('agent/property/address/' . $property->id)}}"
                   class="button button-outlined button-blue font-bold text-base mb-0 mt-5 justify-content-end"><i
                            class="fa fa-arrow-left mr-2"></i> Prev</a>
                <button type="submit" class="button button-blue font-bold text-base mb-0 mt-5 justify-content-end ml-3"
                        data-ripple-light="true">Save & Next <i class="fa fa-arrow-right ml-2"></i></button>
            </div>

        </form>
    </div>
    <script>
        $('.summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 240,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@stop
@extends('layouts.agents.default1')

@section('title', 'Main Gallery Image')

@section('content')
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Main Image</h5>
    </div>
    <div class="nav-tabs w-full py-5 pt-0">
        @if($property_gallerys->count() > 0)
            <nav>
                <ul role="tablist" class="tabs p-0" tab-panel="">
                    @foreach($property_gallery_details as $key => $property_gallery_detail)
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 bg-transparent-color {{ $key === key($property_gallery_details) ? 'active': '' }}"
                               aria-selected="true" aria-controls="image{{$key}}"
                               role="tab">{{$property_gallery_detail['gallery_name']}}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="tabs-content p-2">
                @php $number = 1; @endphp
                @foreach($property_gallery_details as $key => $property_gallery_detail)
                    <div class=" @if($number == 1)? active : '' @endif tab-panel bg-transparent-color"
                         id="image{{$key}}" role="tabpanel">
                        @foreach($property_gallery_detail['images'] as $property_gallery_images)
                            <div class="inline mr-3" id="{{$property_gallery_images['property_image_id']}}">
                                <div class="w-64 pb-0  inline-block relative gallery-image-div"
                                     style="border:1px solid lightgrey;">
                                    <div class="h-52 relative border-b border-grey-400">
                                            <img src="{{asset_s3($property_gallery_images['thumb_name'])}}"
                                                 id="image{{$property_gallery_detail['property_id']}}"
                                                 class="card-image-style" alt="">
                                    </div>
                                    <div class="w-full p-3 text-center">
                                        @if($property_gallery_images['featured_images'] != 1)

                                            <a href="#" title="Feature Gallery image" class="m-5 featuredgalleryimage"
                                               id="featuredgalleryimage"
                                               onclick="saveFeatureGalleryImage('{{ $property_gallery_images['property_images_gallery_id'] }}','{{$property_gallery_detail['gallery_id']}}',this)">Select
                                                Main Image</a>

                                            <a href="#" class="m-5 text-green-900 font-bold currentgalleryimage hidden">Selected
                                                Gallery Image</a>

                                        @else

                                            <a href="#" class="m-5 text-green-900 font-bold currentgalleryimage"
                                               id="currentgalleryimage">Selected Gallery Image</a>

                                            <a href="#" title="Featured Gallery image"
                                               class="m-5 featuredgalleryimage hidden"
                                               onclick="saveFeatureGalleryImage('{{ $property_gallery_images['property_images_gallery_id'] }}','{{$property_gallery_detail['gallery_id']}}',this)">Select
                                                Main Image</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @php $number++ @endphp
                @endforeach

            </div>
        @else
            No Gallery found to set Default Gallery Image. Please click on the 'Photo Gallery' link and add Gallery.
        @endif
        <br>
        <div class="d-flex align-items-center justify-content-end">
            <a href="{{url('agent/galleries/gallery-images')}}"
               class="button button-blue button-outlined font-bold text-base mb-0 mr-3"> <i
                        class="fa fa-arrow-left mr-2"></i> Prev</a>
            <a href="{{url('agent/video/video')}}" class="button button-blue font-bold text-base mb-0 ">Next <i
                        class="fa fa-arrow-right ml-2"></i></a>
        </div>
    </div>

@stop
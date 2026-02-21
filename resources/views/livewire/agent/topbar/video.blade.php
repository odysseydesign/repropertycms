<div>
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Video Header</h5>
        <a href="#"
           onclick="Livewire.dispatch('modal.open', {component: 'video.add', arguments: { 'property': {{ $property->id }} } })"
           class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Add Video
        </a>
    </div>
    <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
        <div class="autoplay-notes">
            <h5 class="text-center">The Video Header is set to Autoplay. <br/>If the User's Browser blocks the autoplay
                of your Video, The User
                can click the Play Arrow.</h5>
        </div>
        @if($property_video)
            <div class="views-form mt-5 property_videos">
                <div class="inline mr-3" id="{{$property_video->id}}">
                    <div class="w-auto pb-0  inline-block relative gallery-image"
                         name="{{ $property_video->video_type}}">
                        @if($property_video->video_type == \App\Enums\VideoType::Dropzone)
                            <video width="285" height="100%" controls autoplay="0">
                                <source src="{{asset('/files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                        type="video/mp4">
                                <source src="{{asset('/files/property_videos/' . $property_video->property_id . '/' . $property_video->file_name)}}"
                                        type="video/ogg"/>
                                Your browser does not support the video tag.
                            </video>
                        @elseif($property_video->video_type == \App\Enums\VideoType::YouTube)
                            <div class="video">
                                <p class="font-bold">YouTube</p>
                                <img src="{{ getYoutubeThumbnail($property_video->video_url) }}"
                                     class="max-w-full h-auto">
                                <a href="#"
                                   onclick="Livewire.dispatch('modal.open', {component: 'video.view', arguments: { 'property': {{ $property->id }}, 'property_video': {{ $property_video->id }} } })">
                                </a>
                            </div>
                        @elseif($property_video->video_type == \App\Enums\VideoType::Vimeo)
                            <div class="video">
                                <p class="font-bold">Vimeo</p>
                                <img src="{{ getVimeoThumbnail($property_video->video_url) }}"
                                     class="max-w-full h-auto">
                                <a href="#"
                                   onclick="Livewire.dispatch('modal.open', {component: 'video.view', arguments: { 'property': {{ $property->id }}, 'property_video': {{ $property_video->id }} } })">
                                </a>
                            </div>
                        @else
                            <x-embed url="{{ $property_video->video_url }}" autoplay="0"/>
                        @endif
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
                                Set this video as Property Header
                            </label>
                        </div>
                        @if($property_header)
                            <div class="autoplay-notes">
                                <b>Please note: </b>this video is set as Property Header.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <p class="text-center mt-5">You've no video set as Cover. Please set one from here. <a
                        class="button button-outlined button-amber m-0" href="{{ route('agent.video.video') }}">Add
                    Video</a></p>
        @endif
    </div>
    <div class="d-flex align-items-center justify-content-end mt-5">
        <a href="{{url('agent/video/video')}}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-3"><i
                    class="fa fa-arrow-left mr-2"></i> Prev</a>
        <a href="{{url('agent/property-topbar/slider')}}" class="button button-blue font-bold text-base mb-0">Next <i
                    class="fa fa-arrow-right ml-2"></i> </a>
    </div>
</div>
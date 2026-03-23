<div x-data="{ confirmId: null }">
    <div class="d-flex align-items-center justify-content-between my-4 flex-wrap page-heading">
        <h5 class="mb-0">Property Videos</h5>
        <a href="#"
           onclick="Livewire.dispatch('open-video-add', { propertyId: {{ $property->id }} })"
           class="btn-blue m-0">
            <i class="fa fa-plus mr-1"></i> Add Video
        </a>
    </div>
    <div class="w-full bg-grey-100 border-2 border-solid border-grey-300 p-5 form-bg">
        <div class="views-form mt-5 property_videos">
            @foreach($property_videos as $property_video)
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
                                   onclick="Livewire.dispatch('open-video-view', { propertyId: {{ $property->id }}, videoId: {{ $property_video->id }} })">
                                </a>
                            </div>
                        @elseif($property_video->video_type == \App\Enums\VideoType::Vimeo)
                            <div class="video">
                                <p class="font-bold">Vimeo</p>
                                <img src="{{ getVimeoThumbnail($property_video->video_url) }}"
                                     class="max-w-full h-auto">
                                <a href="#"
                                   onclick="Livewire.dispatch('open-video-view', { propertyId: {{ $property->id }}, videoId: {{ $property_video->id }} })">
                                </a>
                            </div>
                        @else
                            <x-embed url="{{ $property_video->video_url }}" autoplay="0"/>
                        @endif
                        <div class="card-body">
                            Display as:
                            <a href="#" class="py-1 px-2 mb-1"
                               onclick="Livewire.dispatch('open-video-view', { propertyId: {{ $property->id }}, videoId: {{ $property_video->id }} })">
                                @if ($property_video->featured && $property_video->main_video)
                                    Cover & Featured
                                @elseif ($property_video->main_video)
                                    Cover
                                @elseif ($property_video->featured)
                                    Featured
                                @else
                                    Select Display
                                @endif
                            </a>
                            <button class="button button-red py-1 px-2 mb-1 ml-5 float-right text-red-600"
                                    title="Delete"
                                    type="button"
                                    @click="confirmId = {{ $property_video->id }}">Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-end mt-5">
        <a href="{{url('agent.galleries.default')}}"
           class="button button-blue button-outlined font-bold text-base mb-0 mr-3"><i
                    class="fa fa-arrow-left mr-2"></i> Prev</a>
        <a href="{{url('agent/property-topbar/video')}}" class="button button-blue font-bold text-base mb-0">Next <i
                    class="fa fa-arrow-right ml-2"></i> </a>
    </div>

    {{-- Delete Confirmation Overlay --}}
    <div x-show="confirmId !== null" x-cloak style="position:fixed;inset:0;z-index:9999;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);" @click="confirmId = null"></div>
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
            <div style="position:relative;background:white;border-radius:12px;max-width:400px;width:90%;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Delete Video</h3>
                <p style="color:#6b7280;margin-bottom:20px;">Are you sure you want to delete this video? This action cannot be undone.</p>
                <div style="display:flex;gap:8px;justify-content:flex-end;">
                    <button type="button" @click="confirmId = null" class="button button-grey">Cancel</button>
                    <button type="button" @click="$wire.doDeleteVideo(confirmId); confirmId = null" class="button button-red">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

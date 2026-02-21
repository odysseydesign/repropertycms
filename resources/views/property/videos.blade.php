<section class="bg-white pb-0">
    <div class="container-fluid p-0">
        <div class="row m-0 justify-content-md-center">
            <div class="col-md-12 text-center py-5 property-video-section position-relative">
                <h2 class="px-0 mb-5 property-page-title site-color">Property Video</h2>
                @foreach($property_videos as $property_video)
                    @if($property_video->featured == 1)
                        <div class="property_videos">
                            @if(is_null($property_video->video_url))
                                <video controls id="video" style="cursor:pointer;">
                                    <source src="{{asset('/files/property_videos/')}}/{{$property_video->property_id}}/{{$property_video->file_name}}"
                                            type="video/mp4">
                                    Your browser does not support HTML5 video.
                                </video>
                                <i onclick="playvideo()" id="video-play-icon"
                                   class="fa-regular fa-circle-play position-absolute text-white"
                                   style="top:60% ; left:49%; cursor:pointer; text-shadow:2px 2px 10px white; font-size:46px;"></i>

                            @elseif($property_video->video_type == \App\Enums\VideoType::YouTube)

                                <!-- here get the youtube video link and explode by '/' and find id for pass in src -->
                                @php
                                    $video_url = $property_video->video_url;
                                    if(strpos($property_video->video_url, "?") !== false) {
                                        $tmp = explode("?", $property_video->video_url);
                                        $tmp = explode("&", $tmp[1]);
                                        $tmp = explode("=", $tmp[0]);
                                        $youtube_link = $tmp[1];
                                    } else {
                                        $youtube_link = explode("/",$property_video->video_url);
                                        $youtube_link = $youtube_link[3];
                                    }

                                @endphp
                                <iframe src="https://www.youtube.com/embed/<?= $youtube_link ?>"
                                        frameborder="0"
                                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture, autoplay"
                                        allowfullscreen id="youtube-video"
                                        style="width:100%;aspect-ratio: 1.78;">
                                </iframe>
                            @elseif($property_video->video_type == \App\Enums\VideoType::Vimeo)
                                @php
                                    $video_url = $property_video->video_url;
                                    $vimeo_link = explode("/",$property_video->video_url);
                                    $vimeo_link = $vimeo_link[3];

                                @endphp
                                <iframe src="https://player.vimeo.com/video/<?= $vimeo_link ?>?autoplay=0"
                                        frameborder="0"
                                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture, autoplay"
                                        allowfullscreen id="vimeo-video"
                                        style="width:100%;aspect-ratio: 1.78;">
                                </iframe>

                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
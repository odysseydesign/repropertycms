@props([
	'property',
	'property_videos'
])
@if($property_videos->count() > 0)
    @foreach($property_videos as $property_video)
        @if($property_video->main_video == 1)
            @if($property_video->video_type == \App\Enums\VideoType::Dropzone)
                <video id="myVideo" loop="true" autoplay muted>
                    <source src="{{asset('/files/property_videos/')}}/{{$property_video->property_id}}/{{$property_video->file_name}}"
                            type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
                <i class="fa-sharp fa-solid fa-volume-xmark mute-icon"
                   onclick="volumn_control(this)"></i>
                <script>
                    function volumn_control(obj) {
                        var x = $('#myVideo')[0];
                        if (x.muted) {
                            x.muted = false;
                            obj.classList.remove("fa-volume-xmark");
                            obj.classList.add("fa-volume-high");
                        } else {
                            x.muted = true;
                            obj.classList.remove("fa-volume-high");
                            obj.classList.add("fa-volume-xmark");
                        }
                    }
                </script>
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
                <iframe src="https://www.youtube.com/embed/<?= $youtube_link ?>?enablejsapi=1&autoplay=1&rel=0&mute=1&controls=0"
                        frameborder="0"
                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture, autoplay"
                        allowfullscreen id="youtube-video"
                        style="width:100%;aspect-ratio: 1.78;">
                </iframe>
                <i class="fa-sharp fa-solid fa-volume-xmark fa-2x"
                   id="youtube_volumn_control"
                   style=" position:absolute; top:35px; right:35px; cursor:pointer; color:white;"></i>
                <script>
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    var player;

                    function onYouTubeIframeAPIReady() {
                        player = new YT.Player('youtube-video');
                    }

                    var voulmn_icon = document.getElementById("youtube_volumn_control");
                    voulmn_icon.addEventListener('click', function (event) {

                        if (player.isMuted()) {
                            player.unMute();
                            voulmn_icon.classList.remove('fa-volume-xmark');
                            voulmn_icon.classList.add("fa-volume-high");

                        } else {
                            player.mute();
                            voulmn_icon.classList.remove("fa-volume-high");
                            voulmn_icon.classList.add('fa-volume-xmark');
                        }
                    });
                </script>

            @elseif($property_video->video_type == \App\Enums\VideoType::Vimeo)
                <x-embed-vimeo url="{{ $property_video->video_url }}" />
            @endif
        @endif
    @endforeach
@endif
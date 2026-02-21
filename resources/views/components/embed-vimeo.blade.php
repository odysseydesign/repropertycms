@props([
	'url',
	'autoplay' => 1,
	'loop' => 1,
	'muted' => 1,
	'aspect_ratio' => "16:9"
])
@php
    $ratio = new \BenSampo\Embed\ValueObjects\Ratio($aspect_ratio);
	preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})\/?([a-z0-9]+)?[?]?.*/', $url, $match);
	if (array_key_exists(5, $match)) {
		$vimeo_data = [
            'videoId' => $match[5],
            'videoHash' => isset($match[6]) ? $match[6] : null
            ];
    }
@endphp
<x-embed-responsive-wrapper :aspect-ratio="$ratio">
    <iframe src="https://player.vimeo.com/video/{{ $vimeo_data['videoId'] }}?autoplay={{ $autoplay }}&loop={{ $loop }}&muted={{ $muted }}&title=0&byline=0&portrait=0&background=1"
            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
</x-embed-responsive-wrapper>
<i class="fa-sharp fa-solid fa-volume-high fa-2x volumn"
   onclick="volumn_control_mute(this)"
   style=" position:absolute; top:35px; right:35px; cursor:pointer; color:white; display:none;"></i>

<i class="fa-solid fa-volume-xmark fa-2x volumn"
   onclick="volumn_control_unmute(this)"
   style=" position:absolute; top:35px; right:35px; cursor:pointer; color:white;"></i>
<script>
    const iframe = document.querySelector('iframe');
    const player = new Vimeo.Player(iframe);

    function volumn_control_mute(obj) {
        const elem = document.querySelectorAll('.volumn').forEach(element => element.style.display = 'block')
        player.setVolume(0);
        obj.style.display = "none";
    }

    function volumn_control_unmute(obj) {
        const elem = document.querySelectorAll('.volumn').forEach(element => element.style.display = 'block')
        player.setVolume(1);
        obj.style.display = "none";
    }
</script>

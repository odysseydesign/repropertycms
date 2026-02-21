<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe 
            aria-label="{{ $label }}"
            src="https://player.vimeo.com/video/{{ $videoId }}@if($videoHash)?h={{ $videoHash}}@endif?autoplay=1&loop=1&muted=1&title=0&byline=0&portrait=0"
            frameborder="0"
            allow="autoplay; fullscreen"
            allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>

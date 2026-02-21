@props([
	'url' => '',
	'autoplay' => 0,
	'loop' => 0
])
@php
    $whitelist = ['YouTube', 'Vimeo'];
    $params = [
        'autoplay' => $autoplay,
        'loop' => $loop,
        'title'=>0,
        'byline'=>0,
        'portrait'=>0
      ];

    $attributes = [
      'type' => null,
      'class' => 'iframe-class',
      'data-html5-parameter' => true,
        'width' => 640,
             'height' => 360
    ];
@endphp
<div class="laravel-embed__responsive-wrapper" style="padding-bottom: 56.25%">
    {!! \Merujan99\LaravelVideoEmbed\Facades\LaravelVideoEmbed::parse($url, $whitelist, $params, $attributes) !!}
</div>
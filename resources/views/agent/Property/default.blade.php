@extends('layouts.agents.default1')

@section('title', 'Share URL | ' . $property?->name)

@section('content')
    <div class="w-full rounded mt-4">
        @if($property->count() > 0)
            <div class="url-box">
                <div class="text-xl">
                    <p  id="propertyUrl">{{url('/')}}/{{ $property->unique_url }}</p>
                </div>
                <div class="share">
                    <div class="d-flex align-items-center flex-wrap">
                        <span>share property on - </span>
                        <a class="text-2xl cursor-pointer" onclick="copyPropertyUrl()">
                            <i class="fa-solid fa-link mx-1"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer.php?u={{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-brands fa-facebook mx-1"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-brands fa-whatsapp mx-1"></i>
                        </a>
                        <a href="https://www.instagram.com/share?url={{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-brands fa-instagram mx-1"></i>
                        </a>
                        <a href="https://twitter.com/share?url= {{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-brands fa-twitter mx-1"></i>
                        </a>
                        <a href="mailto:?Subject=TEST&body= {{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-solid fa-envelope mx-1"></i>
                        </a>
                        <a href="https://linkedin.com/shareArticle?mini=true&url= {{url('/')}}/{{ $property->unique_url }}" class="text-2xl">
                            <i class="fa-brands fa-linkedin mx-1 text-sky"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="d-flex align-items-center justify-content-end">
        <a href="{{url('/agent/address/address-map')}}" class=" d-flex align-items-center justify-content-end button button-blue button-outlined font-bold text-base mb-0 mt-5 justify-content-end d-flex ml-auto"><i class="fa fa-arrow-left mr-2"></i> Prev</a>
    </div>
@stop
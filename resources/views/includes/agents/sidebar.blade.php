@php
    $property = session('property');
@endphp
<aside class="md:block md:w-auto" aria-label="Sidebar">
    <ul class="space-y-2 sidebar my-3">
        <li class="{{ (request()->is('agent/property/address/'.$property->id)) ? 'active' : '' }}">
            <a href="{{url('agent/property/address/'.$property->id)}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-database pr-2"></i>
                <span>Details</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property/description')) ? 'active' : '' }}">
            <a href="{{url('agent/property/description')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-file-contract pr-2"></i>
                <span>Description</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property/amenities')) ? 'active' : '' }}">
            <a href="{{url('agent/property/amenities')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-bell-concierge pr-2"></i>
                <span>Amenities</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property/price-feature')) ? 'active' : '' }}">
            <a href="{{url('agent/property/price-feature')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-solid fa-sack-dollar pr-2"></i>
                <span>Price & Features</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property-images/images')) ? 'active' : '' }}">
            <a href="{{url('agent/property-images/images')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-images pr-2"></i>
                <span>Photo Library</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/galleries/gallery-images')) ? 'active' : '' }}">
            <a href="{{url('agent/galleries/gallery-images')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-images pr-2"></i>
                <span>Photo Galleries</span>
            </a>
        </li>
        {{-- old code comented because dont want set main image feature more. --}}
        {{-- <li class="{{ (request()->is('agent/galleries/default-gallery-images')) ? 'active' : '' }}">
            <a href="{{url('agent/galleries/default-gallery-images')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-image pr-2"></i>
                <span>Set Main Image of Gallery</span>
            </a>
        </li> --}}
        <li class="{{ (request()->is('agent/video/video')) ? 'active' : '' }}">
            <a href="{{url('agent/video/video')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-solid fa-video pr-2"></i>
                <span>Property Video</span>
            </a>
        </li>
        <li class="">
            <a href="#"
               class="flex items-center p-3 pl-5 text-base"
               aria-controls="dropdown-website-header" data-collapse-toggle="dropdown-website-header"
               aria-expanded="{{ (request()->is('agent/property-topbar/choose') || request()->is('agent/property-topbar/video') || request()->is('agent/slider/index')) ? 'true' : 'false' }}">
                <i class="fa-solid fa-object-group pr-2"></i>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Website Header</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 4 4 4-4"/>
                </svg>
            </a>
            <ul id="dropdown-website-header"
                class="{{ (request()->is('agent/property-topbar/video') || request()->is('agent/property-topbar/slider') || request()->is('agent/property-topbar/image')) ? '' : 'hidden' }} py-2 space-y-2">
                <li class="{{ (request()->is('agent/property-topbar/video')) ? 'active' : '' }}">
                    <a href="{{url('agent/property-topbar/video')}}"
                       class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i class="fa-sharp-duotone fa-solid fa-video pr-2"></i>Video
                        Header</a>
                </li>
                <li class="{{ (request()->is('agent/property-topbar/slider')) ? 'active' : '' }}">
                    <a href="{{url('agent/property-topbar/slider' )}}"
                       class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i class="fa-sharp-duotone fa-solid fa-images pr-2"></i>Slide
                        Header</a>
                </li>
                <li class="{{ (request()->is('agent/property-topbar/image')) ? 'active' : '' }}">
                    <a href="{{ url('agent/property-topbar/image') }}"
                       class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i class="fa-sharp-duotone fa-solid fa-image pr-2"></i>Image
                        Header</a>
                </li>
            </ul>
        </li>
        <li class="{{ (request()->is('agent/video/3d-video')) ? 'active' : '' }}">
            <a href="{{url('agent/video/3d-video')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-brands fa-unity pr-2"></i>
                <span>3D Tours</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent.property_document.index')) ? 'active' : '' }}">
            <a href="{{route('agent.property_document.index')}}"
               class="flex items-center p-3 pl-5 text-base">
                <i class="fas fa-file-alt pr-2"></i>
                <span>Docs</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent.floorplan.index')) ? 'active' : '' }}">
            <a href="{{route('agent.floorplan.index')}}"
               class="flex items-center p-3 pl-5 text-base">
                <i class="fa-sharp-duotone fa-solid fa-stairs pr-2"></i>
                <span>Floorplans</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/address/address-map')) ? 'active' : '' }}">
            <a href="{{url('agent/address/address-map')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa-solid fa-map-location pr-2"></i>
                <span>Address & Map</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property/default')) ? 'active' : '' }}">
            <a href="{{url('agent/property/default')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fas fa-share-alt pr-2"></i>
                <span>Share Url</span>
            </a>
        </li>
        <li class="{{ (request()->is('agent/property/delete-property')) ? 'active' : '' }}">
            <a href="{{url('agent/property/delete-property')}}" class="flex items-center p-3 pl-5 text-base">
                <i class="fa fa-trash mr-2"></i>
                <span>Delete Property</span>
            </a>
        </li>
    </ul>
</aside>
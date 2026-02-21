<!doctype html>
@php
    $property = session('property');
@endphp
<html lang="en" dir="ltr">

@include('backend.includes.head')

<body class="app sidebar-mini ltr light-mode admin-page">
<!-- Flash message -->
@include('flash-message')

<!-- PAGE -->
<div class="page w-full">
    <!-- admin dashboard header -->
    <div class="agent_menu">
        @include('backend.includes.header')
    </div>
    <div class="main-content">
        <!-- admin content section -->
        @yield('content')
    </div>
</div>

<!-- admin dashboard footer -->
@include('backend.includes.footer')
<!-- admin dashboard foot -->
@include('backend.includes.foot')
<script src="{{ asset('vendor/wire-elements-pro/js/overlay-component.js') }}"></script>
@livewire('modal-pro')
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
@stack('scripts')
</body>
</html>
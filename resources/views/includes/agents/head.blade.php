<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Adding meta for recieve csrf token in custom js file  -->

    <!-- TITLE -->
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- material-tailwind.css -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <x-embed-styles/>

    <link href="{{asset('css/material-tailwind.min.css')}}" rel="stylesheet"/>
    <!-- SummerNote Css -->
    <link href="{{asset('css/summernote-lite.min.css')}}" rel="stylesheet">

    <!-- SummerNote js -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/summernote-lite.min.js')}}"></script>

    <!-- Sortable js Link-->
    <script src="{{asset('js/Sortable.js')}}"></script>
    <!-- DropDown Css -->
    {{--<link href="{{asset('css/dropzone.css')}}" rel="stylesheet"/>--}}

    <!-- STYLE CSS -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/brand.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/view-propery.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet"/>

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <!-- cropper css -->
    <link href="{{asset('css/cropper.css')}}" rel="stylesheet"/>

    <!-- Brand CSS variables (colors + fonts) -->
    @include('includes.brand-styles')

    <script>
        /* Public URL of the website use in JS - web_url */
        @php echo "web_url = \"" . URL::to('/') . "\";"; @endphp
    </script>
</head>
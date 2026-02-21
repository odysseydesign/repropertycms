<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- TITLE -->
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('vendor/wire-elements-pro/css/bootstrap-overlay-component.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <x-embed-styles/>

    <!-- material-tailwind.css -->
    <link href="{{asset('css/material-tailwind.min.css')}}" rel="stylesheet"/>

    <!-- SummerNote Css -->
    <link href="{{asset('css/summernote-lite.min.css')}}" rel="stylesheet">

    <!-- SummerNote js -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/summernote-lite.min.js')}}"></script>


    <!-- STYLE CSS -->
    <link href="{{asset('css/backend/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/custom.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/realtyniterface.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet"/>

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <script>
        /* Public URL of the website use in JS - web_url */
        @php echo "web_url = \"" . URL::to('/') . "\";"; @endphp
    </script>
</head>

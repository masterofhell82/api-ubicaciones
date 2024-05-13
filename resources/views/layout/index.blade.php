<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">


    @vite('resources/css/app.scss')

    @stack('plugin-styles')

    @stack('style')

    <!-- common css -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!-- end common css -->

</head>

<body data-base-url="{{url('/')}}">


    @if(!request()->is('auth/login'))
        @include('layout.header')
    @endif
    <div class="container">
        <div class="page-wrapper full-page mt-5">
            @yield('content')
        </div>
    </div>

    <!-- base js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <script src="{{ asset('assets/src/app.js') }}"></script>
    @stack('custom-scripts')
</body>

</html>

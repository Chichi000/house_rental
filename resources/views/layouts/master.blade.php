<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link id="pagestyle" href="{{ asset('../assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />

    <!-- Fonts -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    @yield('styles')

</head>
{{-- {{asset('path')} --}}

<body class="g-sidenav-show  bg-gray-100">
    {{-- <body class="g-sidenav-show  bg-gray-100"> --}}
    @include('partials.sidebar')
        @yield('content')
    @include('layouts.header')

    <!-- Font Awesome Icons -->
    <script src="{{ asset('https://kit.fontawesome.com/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
    
    <!-- Core -->
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    
    <!-- Theme JS -->
    <script src="{{ asset('../assets/js/soft-ui-dashboard.min.js') }}"></script>
    @yield('scripts')

</body>

</html>

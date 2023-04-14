<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- <link href="../css/design.css" rel="stylesheet" /> --}}
    
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('tenant.register')
    @include('landlord.register')
    @include('property.create-modal')
    @include('users.signin')
    {{-- <body class="g-sidenav-show  bg-gray-100"> --}}
    @include('partials.sidebar')
    <div>
        @yield('content')
    </div>
    @yield('body')
    @include('layouts.header')

</body>

{{-- <script src="../js/design.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>

<!-- Plugin for the charts, full documentation here: https://www.chartjs.org/ -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/plugins/Chart.extension.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.js"></script>
<script src="../assets/js/soft-ui-dashboard.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
</html>

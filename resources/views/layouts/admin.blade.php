<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admins/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admins/icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/admins/images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/admins/images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admins/css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="{{ asset('assets/admins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admins/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/admins/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/admins/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('scripts')
</head>

<body class="body">
    @include('includes.admin.sidebar')
    @include('includes.admin.nav')
    <div class="main-content">
        @yield('content')
    </div>
    @include('includes.admin.footer')
</body>

</html>

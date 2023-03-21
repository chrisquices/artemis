<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light theme-1">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bug Tracker">
    <meta name="keywords" content="bug tracker, software">
    <meta name="author" content="LEFT4CODE">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

    @livewireStyles

</head>

<body class="main">

@include('layouts.topbar')

<div class="wrapper">
    <div class="wrapper-box">

        @include('layouts.navigation')

        @yield('content')

    </div>
</div>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{ asset('assets/js/custom.js') }}"></script>

@livewireScripts

@yield('scripts')

@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}')
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{{ session('error') }}')
    </script>
@endif


</body>
</html>

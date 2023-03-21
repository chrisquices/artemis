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

</head>

<body class="login">

@yield('content')

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

@if($errors->has('email'))
    <script>
        toastr.error('{{ $errors->first('email') }}')
    </script>
@endif

@if($errors->has('password'))
    <script>
        toastr.error('{{ $errors->first('password') }}')
    </script>
@endif

</body>
</html>

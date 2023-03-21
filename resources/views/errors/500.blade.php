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

    <title>404 | {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"/>
</head>

<body class="main">
<div class="container">
    <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
        <div class="-intro-x lg:mr-20">
            <img alt="Midone - HTML Admin Template" class="h-48 lg:h-auto" src="{{ asset('assets/images/error-illustration.svg') }}">
        </div>
        <div class="text-white mt-10 lg:mt-0">
            <div class="intro-x text-8xl font-medium">500</div>
            <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Oops. A server error ocurred</div>
            <div class="intro-x text-lg mt-3">Try again later, we'll see what's up.</div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body data-theme="dark">
    @php
        $routeName = request()->route()->getName();
    @endphp

    <x-navbar role="navigation" ariaLabel="main navigation"></x-navbar>

    @yield('content')
</body>
</html>
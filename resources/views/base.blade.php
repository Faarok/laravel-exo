<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>
<body>
    @php
        $routeName = request()->route()->getName();
    @endphp

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">Agence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => $routeName === 'property.index']) aria-current="page" href="{{ route('property.index') }}">Nos biens</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => $routeName === 'admin.property.index']) href="{{ route('admin.property.index') }}">Gestion des biens</a>
                        </li>

                        <li>
                            <a @class(['nav-link', 'active' => $routeName === 'admin.option.index']) href="{{ route('admin.option.index') }}">Gestion des options</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @if (Auth::user())
                            <a href="{{ route('auth.logout') }}" class="nav-link">Se déconnecter</a>
                        @else
                            <a class="nav-link" href="{{ route('auth.login') }}">Se connecter</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm bg-autogestor">
        <div class="container">
            <a class="navbar-brand bg-autogestor" href="{{ url('#') }}">
                <img src="{{ asset('autoGestorLogo.png') }}" alt="logo AG" height="30">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @guest
                    @else
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
                                    <a class="nav-item nav-link text-white" href="/users">Usuarios</a>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['comum']))
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermissionTo('produtos'))
                                        <a class="nav-item nav-link text-white" href="/products">Produtos</a>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermissionTo('categoria'))
                                        <a class="nav-item nav-link text-white" href="/category">Categorias</a>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermissionTo('marcas'))
                                        <a class="nav-item nav-link text-white" href="/brands">Marcas</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        {{--                            todo aqui vou colocar dropdown de perfil etc--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

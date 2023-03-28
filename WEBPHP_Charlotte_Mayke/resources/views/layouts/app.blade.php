<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trackr</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Trackr
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                @guest()
                @else
                    @if(Auth::user()->role_id == 2)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('labelList') }}">{{__('Labels')}}</a>
                            </li>
                        </ul>
                    @endif
                    @if(Auth::user()->role_id == 3)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('registerShipments') }}">{{__('Verzendingen')}}</a>
                            </li>
                        </ul>
                    @endif
                    @if(Auth::user()->role_id == 1)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('myShipments') }}">{{__('Track & Trace')}}</a>
                            </li>
                        </ul>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('calender') }}">{{__('Kalender')}}</a>
                            </li>
                        </ul>
                    @endif
                    @if(Auth::user()->role_id == 1)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reviewsOverview') }}">{{__('Reviews')}}</a>
                            </li>
                        </ul>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('webshops') }}">{{__('Registratie webshops')}}</a>
                            </li>
                        </ul>
                    @endif
                @endguest

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('switch', 'en') }}">EN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('switch', 'nl') }}">NL</a>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link">|</p>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{__('Inloggen')}}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{__('Registreer')}}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{__('Uitloggen')}}
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

<style>
    ul {
        list-style-type: none;
    }
</style>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBNB</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light-transparent shadow-sm">
            <div class="container">
                <div class="w-100 d-flex justify-content-between">
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <img style="width: 130px" src="{{ Vite::asset('resources/img/bool_bb_logo.svg') }}"
                            alt="logo">
                    </a>

                    <button class="navbar-toggler mob-menu" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </div>


                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                    <div class="navbar-nav ml-auto py-2">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item me-3">
                                <a class="nav-link color_green" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn button-color text-white register"
                                        href="{{ route('register') }}">{{ __('AirBnb Start') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    @if (Auth::user()->name == null)
                                        {{ Auth::user()->email }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('admin/apartments') }}">Appartamenti</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
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
                    </div>
                </div>
            </div>
        </nav>
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>

</html>

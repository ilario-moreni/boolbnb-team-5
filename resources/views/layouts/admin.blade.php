<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-img h-100">
    <div id="app">
        <header class="navbar bg-white flex-md-nowrap p-2 w-100 border-bottom">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">
                <img src="{{ Vite::asset('resources/img/bool_bb_logo.svg') }}" alt="logo">
            </a>
            <div class="d-flex">
                <button class="navbar-toggler mob-menu d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar nav">
                    <div class="nav-item text-nowrap ms-2">
                        <a class="nav-link text-dark btn button-color text-white me-3" href="{{ route('logout') }}"
                            onclick="event.preventDefault()
                        document.getElementById('logout-form').submit()">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            {{-- <input class="form-control form-control-dark w-100" type="text" Placeholder="Search"> --}}
        </header>
        <div class="container-fluid vh-side">
            <div class="row">
                <nav id="sidebarMenu" class="col col-lg-2 d-lg-block sidebar collapse border-end myside">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            {{-- <li class="nav-item">
                                <a class="nav-link text-dark f-20 rounded {{ Route::currentRouteName() == 'admin.dashboard' ? 'selected' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.apartments.index' ? 'selected' : '' }}"
                                    href="{{ route('admin.apartments.index') }}">
                                    <div class="d-flex align-items-center gap-1">
                                        <lord-icon src="https://cdn.lordicon.com/gmzxduhd.json" trigger="loop"
                                            delay="1000" style="width:50px;height:50px">
                                        </lord-icon>
                                        <h6 class="m-0 text-dark"><strong>Appartamenti</strong></h6>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-12 col-lg-10 overflow">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>

</html>

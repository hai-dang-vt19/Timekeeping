<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('blocks.head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm"  data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class='bx bxl-snapchat'></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest @else
                        <ul class="navbar-nav me-auto fs-5">
                            <li class="nav-item me-3">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">{{ __('language.home') }}</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" href="{{ route('index_user') }}">{{ __('language.user') }}</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" href="{{ route('index_group') }}">{{ __('language.group') }}</a>
                            </li>
                        </ul>
                        <form class="d-flex" action="{{ route('search') }}" method="GET">
                            @csrf
                            <input class="form-control me-2" name="search" type="search" placeholder="Search name" aria-label="Search">
                            <button class="btn btn-warning" type="submit">{{ __('language.search') }}</button>
                        </form>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('language.language') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('site.language', ['language'=>'en']) }}">EN</a>
                                <a class="dropdown-item" href="{{ route('site.language', ['language'=>'vi']) }}">VI</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('language.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('language.register') }}</a>
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
                                        {{ __('language.logout') }}
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
    @include('blocks.sctipts')
</body>
</html>

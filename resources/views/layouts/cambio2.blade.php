<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/cambio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home_style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light " style="background-color: rgb(20, 26, 25);">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret text-white"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    
                </div>
            </div>
        </nav>
            <div class="container-fluid ">
                <div class="row">
                        <nav class="col-md-2 navbar navbar-expand-m navbar-light justify-content-start flex-column" id="sidebar">
                                <a class="navbar-brand" href="#">Navbar</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                  <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse flex-column" id="navbarNavAltMarkup">
                                  <div class="navbar-nav flex-column">
                                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                                    <a class="nav-item nav-link" href="#">Features</a>
                                    <a class="nav-item nav-link" href="#">Pricing</a>
                                    <a class="nav-item nav-link disabled" href="#">Disabled</a>
                                  </div>
                                </div>
                        </nav>
                    {{-- <nav class="col-md-2 d-none d-md-block bg-light sidebar justify-content-start" id="sidebar">
                        <ul class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </ul>
                        <ul class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                        </ul>
                        <ul class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                        </ul>
                        <ul class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                        </ul>
                    </nav> --}}

                    <main role="main" class="ml-sm-auto col-md-12 pt-3 px-4S justify-content-start">
                        @yield('content')
                    </main>
                </div>
            </div>
        
    </div>
</body>
</html>



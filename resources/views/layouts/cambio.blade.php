<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sspotify') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Rajdhani" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/cambio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home_style.css') }}" rel="stylesheet">
</head>
<body style="background-color:#323D39">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #112C29">  
            <div class="justify-content-start">
            <div class="text-white" id="brand"> <a class="text-white" href="{{url('/')}}" style="text-decoration:none">Cambio Inc.</a></div>
            </div>
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url("/collection")}}">Home <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url("/search")}}">Search</a>
                        </li>
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

                                <div class="dropdown-menu dropdown-menu-right" style="background-color: #112C29" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white" style="background-color: #112C29" href="{{ route('logout') }}"
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
                    <main role="main" class="ml-sm-auto col-md-12 pt-3 px-4S justify-content-start mt-5">
                        @yield('content')
                    </main>
                </div>
            </div>
        
    </div>
</body>
</html>



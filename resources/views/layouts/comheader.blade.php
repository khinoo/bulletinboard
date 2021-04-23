<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/detailpopup.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <h2 class="text-center font-weight-light my-4 text-primary">SCM Bulletin Board</h2>
                <ul class="navbar-nav ml-auto">
                @if( Auth::user()->type == 0 )
                <li class="nav-item dropdown">
                    <a class="dropdown-item text-primary" href="/userlist" data-toggle="tooltip" data-placement="top" title="Go to the userlist">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="dropdown-item text-primary" href="/profile" data-toggle="tooltip" data-placement="top" title="Go to the user profile">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-item text-primary" href="/postlist" data-toggle="tooltip" data-placement="top" title="Go to the Post List">
                        Posts
                    </a>
                </li>
                </ul>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (!Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="dropdown-item text-primary">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-item text-primary" href="{{ route('logout') }}">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            <div class="footer-copyright text-center py-3">
                <a href="http://seattleconsultingmyanmar.com/en/"> Copyright © Seattle Consulting Myanmar Co., Ltd. All rights reserved.</a>
            </div>
        </footer>
    </div>
</body>
</html>
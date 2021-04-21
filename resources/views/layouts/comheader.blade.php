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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#postdetail', function(event) {
           $id =  $(this).attr('data-id');
           $('#title').val($(".title_"+$id).val());
           $('#description').val($(".des_"+$id).val());
           $('#status').val($(".status_"+$id).val());

            var str = $(".created_at_"+$id).val();
            var cyear = str.substr(0, 4);
            var cmonth = str.substr(5, 2);
            var cdate = str.substr(8, 2);
            var created_at = cyear +'/'+ cmonth +'/'+cdate;

           $('#created_at').val(created_at);
           $('#created_user_id').val($(".created_user_"+$id).val());
        });

         $(document).on('click', '#userdetail', function(event) {
           $id =  $(this).attr('data-id');
           var str = $(".dob_"+$id).val();
            var dobyear = str.substr(0, 4);
            var dobmonth = str.substr(5, 2);
            var dobdate = str.substr(8, 2);
            var dob = dobyear +'/'+ dobmonth +'/'+dobdate;
           $('#username').val($(".name_"+$id).val());
           $('#useremail').val($(".email_"+$id).val());
           $('#phone').val($(".phone_"+$id).val());
           $('#address').val($(".address_"+$id).val());
           $('#dob').val(dob);
        });
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
    });
</script>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <h2 class="text-center font-weight-light my-4">SCM Bulletin Board</h2>
                <ul class="navbar-nav ml-auto">
                @if( Auth::user()->type == 0 )
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="/userlist">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="/profile">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="/postlist">
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
                                <a class="dropdown-item">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
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
    </div>

    <h3 style="margin-left: 300px;">Post List</h3>
<br>
<div class="container">
    <table class="table table-bordered">
    <thead>
        <tr>
          <th scope="col">Post Title</th>
          <th scope="col">Post Description</th>
          <th scope="col">Posted User</th>
          <th scope="col">Posted Date</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($posts))
        @foreach($posts as $post)
        <tr>
          <th scope="row"><a class="btn btn-link" data-id="{{ $post->id }}">{{ $post->title }}</a></th>
          <td>{{ $post->description }}</td>
          <td>{{ $post->name }}</td>
          <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</td>

        <input type="hidden" class="form-control title_{{$post->id}}" id="title" value = "{{ $post->title }}" wire:model="title">
        <input type="hidden" class="form-control des_{{$post->id}}" id="description" value = "{{ $post->description }}" wire:model="description">
        <input type="hidden" class="form-control status_{{$post->id}}" id="status" value = "{{ $post->status }}" wire:model="status">
        <input type="hidden" class="form-control createdat_{{$post->id}}" id="created_at" value = "{{ $post->created_at }}" wire:model="created_at">
        <input type="hidden" class="form-control created_user_{{$post->id}}" id="created_user_id" value = "{{ $post->name }}" wire:model="created_user_id">
        <input type="hidden" class="form-control updatedat_{{$post->id}}" id="updated_at" value = "{{ $post->updated_at }}" wire:model="updated_at">
        <input type="hidden" class="form-control updateuser_{{$post->id}}" id="updated_user_id" value = "{{ $post->name }}" wire:model="updated_user_id">
        </tr>
         @endforeach
         @endif
  </tbody>
</table>
</div>
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>

</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('javascript')
    <script src="/js/confirm.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/52ec063ea9.js" crossorigin="anonymous"></script>
    <link href="/css/layout.css" rel="stylesheet">
</head>
<div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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

        {{--3 columns--}}
        <main class="">
            <div class="row">

                <div class="col-sm-12 col-md-2 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between my-card-header">
                            Tags
{{--                            <input type="hidden" name="tag_id" value="{{ $tag['id'] }}" />--}}
                            <form id="tag-delete-form" action="tag_destroy/{{ \Request::query('tag') }}" method="GET">
                                @csrf
                                <i class="fa-solid fa-circle-xmark mx-3" onclick="tagDeleteHandle(event);"></i>
                            </form>
                        </div>



                        <div class="card-body my-card-body form-inline">
                            <a href="/" class="card-text d-block mb-2">Show all</a>
                            @foreach($tags as $tag)
                                <a href="/?tag={{$tag['id']}}" class="card-text d-block elipsis mb-2">{{$tag['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between my-card-header">
                            To-do List
                            <a href="{{ route('home') }}"><i class="fa-solid fa-circle-plus"></i></a></div>
                        <div class="card-body my-card-body form-inline" >
                            @foreach($memos as $memo)
                                <div class="d-block elipsis mb-2">
                                    <a href="/submit/{{$memo['id']}}" class="card-text elipsis "><i class="fa-solid fa-circle-check"></i></a>
                                    <a href="/edit/{{$memo['id']}}" class="card-text mb-2">{{ $memo['content'] }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </main>

        {{--3 columns for new version--}}
        <main class="">
            <div class="row">

                <div class="col-sm-12 col-md-2 p-0">
                    <div class="card">
                        <div class="card-header my-card-header">Stop Watch</div>
                        <div class="card-body my-card-body" align="center">

                            <p></p>

                            <div id="stopwatch" class="my-stop-watch">
                                00:00:00
                            </div>
                                <button onclick="startTimer()" class="btn btn-primary">start</button>
                                <button onclick="stopTimer()" class="btn btn-primary">Stop</button>
                                <button onclick="resetTimer()" class="btn btn-primary">Reset</button>


                            <script src="main.js"></script>
                            <script>
                                const timer = document.getElementById('stopwatch');

                                var hr = 0;
                                var min = 0;
                                var sec = 0;
                                var stoptime = true;

                                function startTimer() {
                                    if (stoptime == true) {
                                        stoptime = false;
                                        timerCycle();
                                    }
                                }
                                function stopTimer() {
                                    if (stoptime == false) {
                                        stoptime = true;
                                    }
                                }

                                function timerCycle() {
                                    if (stoptime == false) {
                                        sec = parseInt(sec);
                                        min = parseInt(min);
                                        hr = parseInt(hr);

                                        sec = sec + 1;

                                        if (sec == 60) {
                                            min = min + 1;
                                            sec = 0;
                                        }
                                        if (min == 60) {
                                            hr = hr + 1;
                                            min = 0;
                                            sec = 0;
                                        }

                                        if (sec < 10 || sec == 0) {
                                            sec = '0' + sec;
                                        }
                                        if (min < 10 || min == 0) {
                                            min = '0' + min;
                                        }
                                        if (hr < 10 || hr == 0) {
                                            hr = '0' + hr;
                                        }

                                        timer.innerHTML = hr + ':' + min + ':' + sec;

                                        setTimeout("timerCycle()", 1000);
                                    }
                                }

                                function resetTimer() {
                                    timer.innerHTML = '00:00:00';
                                    hr = 0;
                                    min = 0;
                                    sec = 0;
                                    stoptime = true;


                                }
                            </script>






                        </div>
                    </div>
                </div>

                @yield('logs')

                @yield('chart')

        </main>
    </div>
</div>
</body>
</html>

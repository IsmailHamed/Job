<!doctype html>
<html dir="{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/rtl/bootstrap.min.js"></script>
    <script src="/js/mdb.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/{{ app()->getLocale() == "ar" ? "bootstrap-rtl/" : "" }}bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/css/mdb.min.css" rel="stylesheet"/>
    <!-- Your custom styles (optional) -->
    <link href="/css/style.min.css" rel="stylesheet"/>
</head>
<body>
<div id="app">
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{route('Categories.Index')}}">
                        {{__("allResources.Category")}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{route('Job.Index')}}">
                        {{__("allResources.Job")}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{route('Job.ApplyJobByUser')}}">
                        {{__("allResources.Apply job by user")}}
                    </a>
                </li>
            @can('update', App\User::class)
                <!-- The Current User Can Update The Post -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="navbar-brand" href="#" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            {{__("allResources.Power management")}}
                        </a>

                        <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('User.Index')}}">
                                {{__("allResources.Users")}}
                            </a>
                            <a class="dropdown-item" href="{{route('Role.Index')}}">
                                {{__("allResources.Roles")}}
                            </a>
                            <a class="dropdown-item" href="{{route('Permission.Index')}}">
                                {{__("allResources.Permissions")}}
                            </a>
                        </div>
                    </li>
                @endcan
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('allResources.Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('allResources.Register') }}</a>
                        </li>
                    @endif
                    <li class="nav-item active">
                        <a class="navbar-brand" href="/lang">
                            {{ __('allResources.lang') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item avatar dropdown">
                        <a id="navbarDropdown" class="nav-link p-0" href="#" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="/storage/{{ Auth::user()->userImage }}"
                                 class="rounded-circle z-depth-0"
                                 alt="avatar image" height="35">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item">
                                {{ Auth::user()->name }}
                            </a>
                            <a class="dropdown-item" href="/lang">
                                {{ __('allResources.lang') }}
                            </a>
                            <a class="dropdown-item" href="{{route('UserProfile')}}">
                                {{ __('allResources.User profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('allResources.Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>

        </div>
    </nav>
    <!--/.Navbar -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>

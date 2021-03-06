<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Page title')</title>

    <!-- Fonts -->
    <link href="{{ asset('assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/bootstrap-3.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap-rtl-3.3.4/bootstrap-flipped.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap-3.3.6/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('style')
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ url('workflow') }}">Workflow</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guard('web')->check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->full_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('admin.profile.index') }}"><i class="fa fa-btn fa-user"></i> ??????????????</a></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-btn fa-sign-out"></i> ????????</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">???????? ???? ??????????</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('script')
</body>
</html>

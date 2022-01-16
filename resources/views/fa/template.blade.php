<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    {{--<meta name="fontiran.com:license" content="LF3TA"/>--}}
    {{--<meta name="fontiran.com:license" content="UECNB"/>--}}
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta name="language" content="farsi"/>
    <meta name="robots" content="index, follow"/>
    <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon"/>
    <link href="{{ asset('images/touch-icon-iphone.png') }}" rel="apple-touch-icon"/>
    <link href="{{ asset('images/touch-icon-ipad.png') }}" rel="apple-touch-icon" sizes="76x76"/>
    <link href="{{ asset('images/touch-icon-iphone-retina.png') }}" rel="apple-touch-icon" sizes="120x120"/>
    <link href="{{ asset('images/touch-icon-ipad-retina.png') }}" rel="apple-touch-icon" sizes="152x152"/>
    <meta name="DC.Identifier" content="{{ url('/') }}"/>
    <meta name="DC.Date.Created" content="{{ \Carbon\Carbon::now()->format('m/d/Y') }}"/>
    <meta name="DC.Title" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="DC.Description"/>
    <meta name="DC.Language" content="{{ App::getLocale() }}"/>
    <meta name="DC.Publisher" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="og:title" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="og:url" content="{{ url('/') }}"/>
    <meta name="og:site_name" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="og:description"/>
    <meta name="og:type" content="article"/>
    <meta name="og:article:author" content="{{ config('app.name') }} - @yield('title')"/>
    <meta content="{{ config('app.name') }} - @yield('title')" itemprop="name"/>
    <meta itemprop="description"/>
    <meta name="og:locale" content="fa_IR"/>
    <meta name="author" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="publisher" content="{{ config('app.name') }} - @yield('title')"/>
    <meta name="generator" content="{{ config('app.author') . ' - ' . config('app.copyright') }}"/>
    <meta name="copyright" content="© 2018 {{ config('app.name') }}"/>
    <link href="{{ asset('css/bootstrap.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/Default-fa-IR.css') }}" type="text/css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/Sampa.Web.WebResources.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/Glyphicons.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    @yield('style')

    <!--[if lt IE 9]>
    <script language='JavaScript' src="{{ asset('js/respond.min.js') }}" type='text/javascript'></script>
    <![endif]-->


    <!--[if lt IE 9]>
    <script language='JavaScript' src='{{ asset(' js/html5shiv.min.js') }}' type='text/javascript'></script>
    <![endif]-->
    <link id="ctl00_MegaMenuStyle" href="{{ asset('css/MegaMenu.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>
<!-- END WAYBACK TOOLBAR INSERT -->
<div id="generalMainWrap">

        <div>
            <input type="hidden" name="ctl00_rssmStyleSheet_TSSM" id="ctl00_rssmStyleSheet_TSSM" value=""/>
            <input type="hidden" name="ctl00_rsmAll_TSM" id="ctl00_rsmAll_TSM" value=""/>

        </div>

        <script src="{{ asset('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/Functions.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-tabcollapse.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/FancyBox.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.jplayer.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/MatchHeight.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/menu3d.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.lightSlider.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.capty.min.js') }}" type="text/javascript"></script>

        @include(App::getLocale().'.header')

        <section class="mainContentWrap">
            <div class="container">
                <div class="col-md-10 col-md-offset-1 col-lg-np col-md-np  col-xs-12">


                    <div class="row">
                        <article class="col-xs-12 col-sm-12 col-md-9 middleColumn">

                            <div class="beforeMiddle col-xs-12 col-xs-np col-md-np col-sm-np col-lg-np">
                                <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-0 col-sm-offset-1 col-xs-np col-md-np col-sm-np col-lg-np">

                                    @yield('content')

                                </div>

                                @include(App::getLocale().'.aside')

                            </div>

                        </article>

                        @include(App::getLocale().'.ads')

                    </div>

                </div>
            </div>
        </section>

        @include(App::getLocale().'.footer')

        <script type="text/javascript">
            $(document).ready(function () {
                $('.row531 .col-cms .inner .panel-heading').matchHeight();
                $('.row531 .col-cms .inner .panel-body').matchHeight();
            });
        </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".headerMatchHeight").matchHeight();
            $('.customSearchIcon .searchToggle').on('click', function (e) {
                e.preventDefault();
                $(".customSearch").toggle("slow");
                $(this).toggleClass("closeIcon");
            });

            $(".dateStyle .lightSliderWrapper li").each(function () {
                $(this).find('.sliderDate').appendTo($(this).find('.sliderInformation').eq(0));
            });
        });
    </script>
</div>
<div class="goToTop"></div>
</body>
</html>
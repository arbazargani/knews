@inject('objMenu', 'App\Libraries\Menu')
        <!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/plugins/_tasin/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/_tasin/css/style_backup.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/_tasin/css/style.css') }}"/>

    <link href="{{ asset('assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>

    @stack('style')

    <script src="{{ asset('assets/plugins/_tasin/js/jquery-1.11.3.js') }}"></script>
    <script src="{{ asset('assets/plugins/_tasin/js/bootstrap.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- start site header -->
<div class='container-full site-header-container'>
  <div></div>
  <div class="container">
    <div class='row'>
        <div class='col-md-12'>
            <div class='site-header'>
              <div class="topbar-container">
                <div class='row'>
                  <div class="col-sm-7">
                    <span class="today">امروز: شنبه ۲۱ فروردین ۱۳۹۵</span>
                  </div>
                    <div class="col-sm-5">
                        <div class='share-icons'>
                            <a data-toggle="tooltip" data-placement="bottom" title="RSS" id='rss-link' href="#">
                                <i class="fa fa-rss share "></i>
                            </a>
                            <a data-toggle="tooltip" data-placement="bottom" title="Facebook" id='facebook-link' href="#">
                                <i class="fa fa-facebook share "></i>
                            </a>
                            <a data-toggle="tooltip" data-placement="bottom" title="Twitter" id='tumblr-link' href="#">
                                <i class="fa fa-tumblr share "></i>
                            </a>
                        </div>

                        <div class='share-languege'>
                            <a data-toggle="tooltip" data-placement="top" title="Hooray!" href="#">English</a> <a
                                    href="#">پارسی</a>
                        </div>

                    </div>
                </div>
              </div>
              
              <div class="col-xs-offset-2 col-xs-8 col-sm-offset-0 col-sm-6">
                <div class="pana-logo"></div>
                <div class="pana-header-title">خبرگزاری پانا</div>
                <div class="pana-header-title-eng">
                  <span>Pupils </span>
                  <span>Association </span>
                  <span>News </span>
                  <span>Agency</span>
                </div>
              </div>
              
              
              <div class="col-xs-offset-2 col-xs-8 col-sm-offset-0 col-sm-6 search-container">
                <div class="">
                  <form id='search-form'>
                      <input class="search-query" type="text" placeholder='جستجــــو...'/>
                      <button type="submit" class="btn btn-info search-btn">
                          <i class="fa fa-search"></i>
                      </button>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- end site header -->

<!-- end menu -->
<div class="navbar-container container-full">
  <div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='menubar-container'>

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                        class="icon-bar"></span> <span class="icon-bar"></span>
                            </button>

                        </div>

                        <div id="cssmenu" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                @foreach($objMenu->home() as $menu)
                                    @if( empty($menu['children']) )
                                        <li><a href="{{ $menu['link'] }}">{{ $menu['title'] }}</a></li>
                                    @else
                                        <li class='has-sub dropdown'>
                                            <a href="{{ $menu['link'] }}">{{ $menu['title'] }}<span class="caret"></span></a>
                                            <ul>
                                                @foreach($menu['children'] as $menu)
                                                    @if( empty($menu['children']) )
                                                        <li><a href="{{ $menu['link'] }}">{{ $menu['title'] }}</a></li>
                                                    @else
                                                        @foreach($menu['children'] as $menu)
                                                            @if( empty($menu['children']) )
                                                                <li><a href="{{ $menu['link'] }}">{{ $menu['title'] }}</a></li>
                                                            @else
                                                                @foreach($menu['children'] as $menu)
                                                                    <li><a href="{{ $menu['link'] }}">{{ $menu['title'] }}</a></li>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        </ul>

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->


            </nav>
            </div><!-- /.container-fluid -->


        </div>
    </div>
  </div>
</div>
<!-- end menu -->


@yield('content')

        <!-- start footer -->
<div class="col-lg-12">
    <div class="footer-container text-center">
        Copyright @ Your Wesite 2015
    </div>
</div>
<!-- end footer -->

@push('script');
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endpush

@stack('script')
</body>
</html>
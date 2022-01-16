@inject('objMenu', 'App\Libraries\Menu')
<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js" dir="rtl"> <![endif]--><!--[if IE 9]>
<html lang="en" class="ie9 no-js" dir="rtl"> <![endif]--><!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>@yield('title', 'مدیریت')</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/plugins/bootstrap_3.3.6/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-switch_3.3.2/css/bootstrap-switch-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/components-md-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/plugins-md-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/layout-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/themes/darkblue-rtl.min.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
    <!-- END THEME LAYOUT STYLES -->

    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/assets/packs/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

    @stack('style')

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <style>
        select.form-control {
            padding-top:0 !important;
        }
        .thumb-div img {
            width: 200px;
        }
    </style>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#" target="_blank">
                <img src="{{ asset('images/logo-hor2.png') }}" alt="logo" class="logo-default" style="margin-top:5px; height:35px;"/>
            </a>

            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                @include('_layouts.admin.notification')
                @include('_layouts.admin.inbox')
                @include('_layouts.admin.tasks')

                        <!-- BEGIN USER LOGIN DROPDOWN -->

                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" style="padding: 12px !important;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="{{ asset('files/_temp/avatar3_small.jpg') }}"/>
                        <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                        <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-default">

						{{--<li>--}}
                            {{--<a href="{{ route('admin.users.show',['id'=>Auth::user()->id ]) }}"> <i class="icon-user"></i> پروفایل </a>--}}
                        {{--</li>--}}
						{{--<li>--}}
                            {{--<a href="{{ route('admin.portal.setting') }}"> <i class="fa fa-cog "></i> تنظیمات سایت </a>--}}
                        {{--</li>--}}
                        <!--
                        <li>
                            <a href="{{ url('app_inbox.html') }}"> <i class="icon-envelope-open"></i> پیام های رسیده <span class="badge badge-danger"> 3 </span> </a>
                        </li>
                        <li>
                            <a href="{{ url('app_todo.html') }}"> <i class="icon-rocket"></i> وظایف من <span class="badge badge-success"> 7 </span> </a>
                        </li>-->
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"> <i class="icon-key"></i> خروج از سیستم </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->

                <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                {{--<li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle"> <i class="icon-logout"></i> </a>
                </li>--}}
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER --><!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER --><!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->

        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->

            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->

            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->

            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->

            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing --><!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->

            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"></div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                @foreach($objMenu->admin() as $key => $menu)
                    @if( empty( $menu['is_header'] ) )
                        <li id="{{ $menu['id'] }}" class="nav-item @if($key == 0) start @endif">
                            <a href="javascript:;" class="nav-link nav-toggle"> <i class="{{ $menu['icon'] }}"></i>
                                <span class="title">{{ $menu['title'] }}</span> <span class="arrow"></span> </a>
                            <ul class="sub-menu">
                                @foreach($menu['sub'] as $sub)
                                    <li class="nav-item">
                                        @if( empty($sub['sub']) )
                                            <a href="{{ $sub['link'] }}" class="nav-link">
                                                <i class="{{ $sub['icon'] }}"></i>
                                                <span class="title">{{ $sub['title'] }}</span> </a>
                                        @else
                                            <a href="javascript:;" class="nav-link nav-toggle">
                                                <i class="{{ $sub['icon'] }}"></i>
                                                <span class="title">{{ $sub['title'] }}</span> <span class="arrow"></span>
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach($sub['sub'] as $sub2)
                                                    <li class="nav-item">
                                                        <a href="{{ $sub2['link'] }}" class="nav-link "> {{ $sub2['title'] }} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="heading">
                            <h3 class="uppercase">{{ $menu['title'] }}</h3>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!-- END SIDEBAR MENU --><!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">@yield('page-bar')</div>
            @yield('content')
        </div>
    </div>

    @include('_layouts.admin.sidebar')
</div>
<!-- END CONTAINER -->

<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy;
        <a href="http://Toca.ir" title="preview" target="_blank">Toca.ir</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<!--[if lt IE 9]>
<script type="text/javascript" src="{{ asset('assets/plugins/respond-1.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/excanvas.min.js') }}"></script><![endif]-->

<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap_3.3.6/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/js.cookie-2.0.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-hover-dropdown-2.0.1/bootstrap-hover-dropdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery-slimscroll-1.3.2/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.blockui-2.70.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-switch_3.3.2/js/bootstrap-switch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.getScriptOnce.js') }}"></script>

<script type="text/javascript">
    var base_url = "{{ url('').'/' }}";

    $(document).ready(function () {
        $('#menu-@yield('menu_active', 'dashboard')').addClass('active open').find('>a').append('<span class="selected"></span>').find('>span.arrow').addClass('open');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    });
</script>
<script type="text/javascript" src="{{ asset('assets/plugins/_admin-4.5.4/scripts/app.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/_admin-4.5.4/scripts/layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/_admin-4.5.4/scripts/quick-sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/packs/moment/min/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/packs/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/persian-date-0.1.8.min.js') }}"></script>
@stack('script_lib')

@stack('script')
<script>
    function processFileEditorBrowse(file) {
        fi = '{{url('')}}' + file.url;
        fi = file;
        $('.cke_dialog_ui_input_text').eq(3).val(fi)
    }
</script>
</body>
</html>
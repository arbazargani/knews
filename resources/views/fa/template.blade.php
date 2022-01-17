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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
<script>
    $('.ajax-loading').hide();
</script>
@if(\Request::route()->getName() == 'tag.show')
<!-- <script>
    !function(n){var a={url:null,autoload:!0,data:{page:1,size:10},before:function(){n(this.loading).fadeIn()},after:function(a){n(this.loading).fadeOut(),n(a).fadeInWithDelay()},scroller:n(window),heightOffset:20,loading:"#loading",loadingText:"Wait a moment... it's loading!",loadingNomoreText:"No more.",manuallyText:"click to loading more."};n.fn.scrollPagination=function(t){var o=n.extend(a,t);o.scroller;return this.each(function(){n.fn.scrollPagination.init(n(this),o)})},n.fn.stopScrollPagination=function(a=null,t=null){if(null==a)return this.each(function(){n(this).attr("scrollPagination","disabled")});n(t.loading).text(t.loadingNomoreText).fadeIn(),n(a).attr("scrollPagination","disabled")},n.fn.scrollPagination.loadContent=function(a,t){t.scroller;null!=t.before&&t.before(),n(a).children().attr("rel","loaded"),n.ajax({type:"POST",url:t.url,data:t.data,dataType:"json",success:function(o){var l="";null!=o.content&&(n(t.loading).text(t.loadingText),n.each(o.content,function(n,a){l+="<li style='opacity:0;-moz-opacity: 0;filter: alpha(opacity=0);'><p>"+a+"</p></li>",dataCount=parseInt(n)+1}),n(a).append(l),dataCount<t.data.size?t.data.page++:n.fn.stopScrollPagination(a,t));var i=n(a).children("[rel!=loaded]");null!=t.after&&t.after(i)}})},n.fn.scrollPagination.init=function(a,t){var o=t.scroller;n(a).attr("scrollPagination","enabled"),0===n(a).children().length&&n.fn.scrollPagination.loadContent(a,t),!0===t.autoload?n(o).scroll(function(l){"enabled"==n(a).attr("scrollPagination")?Math.ceil(n(o).scrollTop())+t.heightOffset>=n(document).height()-n(o).height()&&n.fn.scrollPagination.loadContent(a,t):l.stopPropagation(a,t)}):(t.loadingText=t.manuallyText,n(t.loading).text(t.loadingText).fadeIn().on("click",function(o){"enabled"==n(a).attr("scrollPagination")?n.fn.scrollPagination.loadContent(a,t):o.stopPropagation(a,t)}))},n.fn.fadeInWithDelay=function(){var a=0;return this.each(function(){n(this).delay(a).animate({opacity:1},200),a+=100})}}(jQuery);
    var page = 1;
    $(function(){
        $('#content').scrollPagination({
            'url': '/json/'+page, // The url you are fetching the results.
            'data': {
                // These are the variables you can pass to the request
                'page': page, // Which page at the firsttime
                'size': 15, // Number of pages
            },
            'scroller': $(window), // Who gonna scroll? default is the full window
            'autoload':false, // Change this to false if you want to load manually, default true.
            'heightOffset': 0, // It gonna request when scroll is 10 pixels before the page ends
            'loading': "#results", // ID of loading prompt.
            'loadingText': 'در حال بارگذاری ...', // Text of loading prompt.
            'loadingNomoreText': 'موردی یافت نشد.', // No more of loading prompt.
            'manuallyText': 'نمایش موارد بیشتر.', // Click of loading prompt.
            'before': function(){
                // Before load function, you can display a preloader div
                // example:
                $(this.loading).fadeIn();
                console.log('p -> ' + page);
            },
            'after': function(elementsLoaded){
                // After loading content, you can use this function to animate your new elements
                // example:
                $(this.loading).fadeOut();
                $(elementsLoaded).fadeInWithDelay();
                page++;
            }
        });
    });
</script> -->
<script>
   !function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);
    $.fn.isOnScreen = function(){
        
        var win = $(window);
        
        var viewport = {
            top : win.scrollTop(),
            left : win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();
        
        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();
        
        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        
    };


    @if(\Request::route()->getName() == 'tag.show')
    var SITEURL = "/tags/{{$tag->id}}/json/";
    @else
    var SITEURL = "/json/home/";
    @endif
   var page = 0;
   $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height() || $('#loader').isOnScreen()) { //if user scrolled from top to bottom of the page
        page++; 
        load_more(page);
      }
    });
    function load_more(page) {
        $.ajax({
           url: SITEURL + page,
           type: "get",
           datatype: "html",
           beforeSend: function()
           {
              $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
            //notify user if nothing to load
            $('.ajax-loading').html("No more records!");
            return;
          }
          $('.ajax-loading').hide(); //hide loading animation once data is received
          $("#results").append(data); //append data into #results element          
        //   page++;
        })
       .fail(function(jqXHR, ajaxOptions, thrownError)
       {
          console('No response from server');
       });
    }
</script>
<script>
        // !function(t){var i=t(window);t.fn.visible=function(t,e,o){if(!(this.length<1)){var r=this.length>1?this.eq(0):this,n=r.get(0),f=i.width(),h=i.height(),o=o?o:"both",l=e===!0?n.offsetWidth*n.offsetHeight:!0;if("function"==typeof n.getBoundingClientRect){var g=n.getBoundingClientRect(),u=g.top>=0&&g.top<h,s=g.bottom>0&&g.bottom<=h,c=g.left>=0&&g.left<f,a=g.right>0&&g.right<=f,v=t?u||s:u&&s,b=t?c||a:c&&a;if("both"===o)return l&&v&&b;if("vertical"===o)return l&&v;if("horizontal"===o)return l&&b}else{var d=i.scrollTop(),p=d+h,w=i.scrollLeft(),m=w+f,y=r.offset(),z=y.top,B=z+r.height(),C=y.left,R=C+r.width(),j=t===!0?B:z,q=t===!0?z:B,H=t===!0?R:C,L=t===!0?C:R;if("both"===o)return!!l&&p>=q&&j>=d&&m>=L&&H>=w;if("vertical"===o)return!!l&&p>=q&&j>=d;if("horizontal"===o)return!!l&&m>=L&&H>=w}}}}(jQuery);
        
    //     function loadMore() {
    //         instance = document.getElementById('load_more');
    //         if (isElementInViewport(instance)) {
    //             // console.log('it is')
    //         } else {
    //             // console.log('it isn't')
    //         }
    //     }

    //     function isElementInViewport(el) {
    //         var rect = el.getBoundingClientRect();

    //         return rect.bottom > 0 &&
    //             rect.right > 0 &&
    //             rect.left < (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */ &&
    //             rect.top < (window.innerHeight || document.documentElement.clientHeight) /* or $(window).height() */;
    //     }

    //     $.fn.isOnScreen = function(){
            
    //         var win = $(window);
            
    //         var viewport = {
    //             top : win.scrollTop(),
    //             left : win.scrollLeft()
    //         };
    //         viewport.right = viewport.left + win.width();
    //         viewport.bottom = viewport.top + win.height();
            
    //         var bounds = this.offset();
    //         bounds.right = bounds.left + this.outerWidth();
    //         bounds.bottom = bounds.top + this.outerHeight();
            
    //         return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
            
    //     };

    //     let skip = 1;
    //     function injectContent(skip) {
    //         // console.log("url: /json/"+skip)
    //         const xhttp = new XMLHttpRequest();
    //         xhttp.onload = function() {
    //             let res = JSON.parse(this.responseText)
    //             document.getElementById("load_more").innerHTML += res.content;
    //             skip = res.next;
    //         }
    //         xhttp.open("GET", "/json/" + skip);
    //         xhttp.send();
    //     }

    //     $(window).scroll(function(){
    //         // console.log($('#loader').isOnScreen())
    //         if ($('#loader').isOnScreen()) {
    //             setInterval(injectContent(skip), 10000);
    //             // injectContent(skip);
    //         }
    //     });
    // </script>
    @endif
</html>
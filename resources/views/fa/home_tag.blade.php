@extends(App::getLocale().'.template')

@section('title',trans('custom.main_page'))

@section('content')

    <div id="" class=" col-xs-12">
        <div id="" class="row row531">
            <div id=""
                 class="col-cms col-md-12 newsSlider dateStyle" style="padding-right: 0px">
                <div class="inner ">
                    <div class="panel panel-style2 ">
                        <div class="panel-body">
                            <div id=""
                                 class="lightSliderWrapper noPrint">

                                <ul id="slider"
                                    class="content-slider">
                                    @if (!empty($news_titr1))
                                        @foreach($news_titr1 as $key=>$val)
                                            <li style="" class="item{{ $key }}">
                                                <div class="sliderItemContainer">
                                                    <div class="sliderDate"
                                                         style="width:620px">{{ jDate::forge($val->created_at)->format('%d %B %Y') }}</div>
                                                    <div class="sliderInformation"><p class="sliderTitle"><a
                                                                    href="{{ route('news.show', [$val->id , str_slug_fa($val->title)]) }}"
                                                                    target="_blank">{{ $val->title }}</a></p></div>
                                                    <a href="{{ route('news.show', [$val->id , str_slug_fa($val->title)]) }}"
                                                       target="_blank" style="width:445px" class=" sliderLink"
                                                       data-fancybox-group="ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlMain">
                                                        <h3 style="padding:0px !important;width:455px;height:290px; "
                                                            class="lightSliderImageWrapper "><img class="sliderImage "
                                                                                                  src="{{ image_url($val->image_url , 455,290 ,false) }}"
                                                                                                  alt="{{ str_slug_fa($val->title) }}"
                                                                                                  title="{{ str_slug_fa($val->title) }}"
                                                                                                  style="width:455px;height:290px;"/>
                                                        </h3></a>
                                                    <div class="sliderInformation"><p class="sliderDescription">
                                                            {{ $val->descr }}
                                                            <a href="{{ route('news.show', [$val->id , str_slug_fa($val->title)]) }}"
                                                               target="_blank">...</a></p></div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="loadingLightSlider">
                                    <img src="{{ url('images/CircleLoading.svg') }}" alt="Loading"
                                         class="img-responsive center-block"/>
                                </div>
                            </div>
                            <script type="text/javascript">
                                var sliderslider;
                                var badBrowser = !$.support.leadingWhitespace | navigator.appVersion.indexOf("MSIE 9") != -1;

                                function InitializeSliderctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider() {
                                    sliderslider = $("#slider").lightSlider({
                                        item: 1,
                                        enableTouch: false,
                                        rtl: true,
                                        pager: false,
                                        loop: false,
                                        slideMove: 1,
                                        auto: false,
                                        easing: badBrowser ? '' : 'cubic-bezier(0.25, 0, 0.25, 1)',
                                        speed: 1000,
                                        pause: 5000,
                                        pauseOnHover: true,
                                        gallery: false,
                                        thumbItem: 0,
                                        slideMargin: 0,
                                        slideEndAnimation: false,
                                        controls: true,
                                        responsive: [
                                            {
                                                breakpoint: 1200,
                                                settings: {
                                                    item: 1,
                                                    slideMove: 1
                                                }
                                            },
                                            {
                                                breakpoint: 992,
                                                settings: {
                                                    item: 1,
                                                    slideMove: 1
                                                }
                                            },
                                            {
                                                breakpoint: 768,
                                                settings: {
                                                    item: 1,
                                                    slideMove: 1
                                                }
                                            },
                                            {
                                                breakpoint: 450,
                                                settings: {
                                                    item: 1,
                                                    slideMove: 1
                                                }
                                            }
                                        ]
                                    });

                                    sliderslider.settings.onBeforeSlide = function (el) {
                                        var players = $("#slider .mediaPlayer .Player");
                                        players.each(function () {
                                            try {
                                                $(this).data("jPlayer").pause();
                                            } catch (e) {

                                            }
                                        });
                                    };

                                    $('#ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlNext').on('click', function (e) {
                                        sliderslider.goToNextSlide();
                                    });
                                    $('#ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlPrevious').on('click', function (e) {
                                        sliderslider.goToPrevSlide();
                                    });

                                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                                        sliderslider.refresh();
                                    });

                                    $('#undefined-accordion').on('shown.bs.collapse', function (e) {
                                        sliderslider.refresh();
                                    });

                                    if ($('#slider li .sliderTitle').css('position') !== 'absolute') {
                                        $("#slider li .sliderTitle a").matchHeight();
                                        $("#slider li .sliderTitle").matchHeight();
                                        $("#slider li .sliderDescription").matchHeight();
                                    }
                                }

                                function InitializeCaptyctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider() {
                                    $('#ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlMain .captyTitle').capty({
                                        height: 50,
                                        opacity: .9
                                    });
                                }

                                $(document).ready(function () {
                                    $('#slider').hide();
                                    $('#slider').waitForImages(function () {
                                        $('#slider').show();
                                        $('#slider').siblings('.loadingLightSlider').hide();
                                        InitializeSliderctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider();


                                        if ($(window).width() < 992) {
                                            $(".lightSliderImageWrapper").removeClass("pull-right pull-left");
                                        }
                                    });
                                });
                            </script>

                            <a id="" class="newsArchiveLink"></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="" class="row row531">
            <div id=""
                 class="col-cms col-lg-6 col-md-6 newsList">
                <div class="inner ">

                    <div id="" class="row">

                        <div id="load_more"
                             class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            @if (isset($news_titr2))
                                @foreach($news_titr2 as $nt2)
                                    @include('fa.partial.one_news' , ['data'=> $nt2 ])
                                @endforeach
                            @endif

                            <div id="results"></div>
                            <div class="ajax-loading">در حال بارگزاری ...</div>
                        </div>

                    </div>

                </div>
                <div id="loader" class="loader"></div>
            </div>
            <div id="ctl00_cphBeforeMiddleRight_pnl21cphBeforeMiddleRight_137"
                 class="col-cms col-lg-6 col-md-6 customNewsList titleCount">
                <div class="inner ">

                    <div id="" class="row">
                        @if (!empty($news_titr3))
                            @foreach($news_titr3 as $key => $val)
                                <div id=""
                                     class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="newsListItem">
                                        <div id="" class="newsListTitle">

                                            <h3>
                                                <a id=""
                                                   title="{{ jDate::forge($val->created_at)->format('%d %B %Y') }}"
                                                   href="{{ route('news.show', [$val->id , str_slug_fa($val->title)]) }}"
                                                   target="_parent">{{ $val->title }}</a>
                                            </h3>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div id="t3_results"></div>
                            <div class="t3_ajax-loading">در حال بارگزاری ...</div>
                            <div id="t3_loader" class="loader"></div>
                        @endif
                        <div class="col-md-12">

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
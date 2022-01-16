@extends( App::getLocale().'.template')

@section('title', 'Tag List - کلید واژه ها - پیشنهاد ما'  )

@section('content')

    <div class="sliderInformation" style="padding-right: 20px; border-right: 3px solid #f18c19; margin-top: 16px; ">
        <p class="sliderTitle">
            <a target="_blank"> پیشنهاد ما </a>
        </p>
    </div>

    <div id="" class=" col-xs-12">
        <div id="" class="row row531">
            <div id="ctl00_cphBeforeMiddleRight_pnl00cphBeforeMiddleRight_132"
                 class="col-cms col-md-12 newsSlider dateStyle" style="padding-right: 0">
                <div class="inner ">
                    <div class="panel panel-style2 ">
                        <div class="">
                            <div id=""
                                 class="lightSliderWrapper noPrint">
                                <div id=""
                                     class="col-cms col-lg-12 col-md-12 customNewsList titleCount padding-bottom-20 margin-bottom-20">
                                    <div class="inner">
                                        <div id="" class="row">
                                            @foreach($tags->chunk(3) as $chunked_coupons)

                                                @foreach( $chunked_coupons as $val )

                                                    <div class="newsContainer newsListWrapper col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 0">
                                                        <div class="newsListItem">
                                                            <div id="" class="newsListTitle">
                                                                <h3>
                                                                    <a style="font-size: 12px" id=""
                                                                       title="{{ jDate::forge($val->created_at)->format('%d %B %Y') }}"
                                                                       href="{{ route('tag.show',[$val->id , str_slug_fa($val->title)]) }}"
                                                                       target="_parent">{{ $val->title }}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                            @endforeach


                                        </div>
                                        <div id="" class="row">
                                            <div class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                {{--{{ $tags->links() }}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .sliderInformations {
            text-align: justify;
            margin-bottom: 5px;
            padding-bottom: 10px;
        }

        .socialnetwork {
            border-bottom: #ba3e3c 2px solid;
            text-align: left;
            direction: ltr;
        }

        .padding-bottom-20 {
            padding-bottom: 20px;
        }

        .btn-lg, .btn-group-lg > .btn {
            padding: 1px 5px;
            font-size: 20px;
        }
    </style>
@endsection

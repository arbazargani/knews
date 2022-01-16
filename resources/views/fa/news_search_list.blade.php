@extends( App::getLocale().'.template')

@section('title', 'Tag List - کلید واژه ها - پیشنهاد ما'  )

@section('content')

    <div class="sliderInformation" style="padding-right: 20px; border-right: 3px solid #f18c19; margin-top: 16px; ">
        <p class="sliderTitle">
            <a target="_blank"> {{ $text }} </a>
        </p>
    </div>

    <div id="" class=" col-xs-12">
        <div id="" class="row row531">
            <div id="ctl00_cphBeforeMiddleRight_pnl00cphBeforeMiddleRight_132"
                 class="col-cms col-md-12 newsSlider dateStyle" style="padding-right: 0px">
                <div class="inner ">
                    <div class="panel panel-style2 ">
                        <div class="">
                            <div id=""
                                 class="lightSliderWrapper noPrint">
                                <div id=""
                                     class="col-cms col-lg-12 col-md-12 customNewsList titleCount padding-bottom-20 margin-bottom-20">
                                    <div class="inner">
                                        <div id="" class="row">
                                            @foreach($news as $key=>$val)
                                                <div class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="newsListItem">
                                                        <div id="" class="newsListTitle">
                                                            <h3>
                                                                <a id=""
                                                                   title="{{ jDate::forge($val->created_at)->format('%d %B %Y') }}"
                                                                   href="{{ route('news.show',[$val->id , str_slug_fa($val->title)]) }}"
                                                                   target="_parent">{{ $val->title }}</a>
                                                            </h3>
                                                            {{--<div style="margin-right: 20px;text-align: justify;">
                                                                <h6>
                                                                    {{ $val->descr }}
                                                                    <a id="" style="padding-left: 15px;background: url({{ url('images/News-More.png') }}) left 4px no-repeat;color: #666666;"
                                                                       title="..." href="{{ route('news.show',[$val->id , str_slug_fa($val->title)]) }}" target="_parent">...</a>
                                                                </h6>
                                                            </div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!--
										<div id="" class="row">
                                            <div style="text-align: center" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                {{ $news->links() }}
                                            </div>
                                        </div>
										-->
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

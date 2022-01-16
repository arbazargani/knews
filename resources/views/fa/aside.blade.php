@inject('NewsTitr2' , '\App\Libraries\NewsInject' )
<style>
    .newsList{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
</style>
<div class="col-md-4 col-sm-10 col-xs-12 col-md-offset-0 col-sm-offset-1 col-xs-np col-md-np col-sm-np col-lg-np">
    <div id="ctl00_cphBeforeMiddleLeft_Container532" class=" col-xs-12">
        <div id="ctl00_cphBeforeMiddleLeft_cphBeforeMiddleLeft_row_532_0" class="row row532">
            <div id="ctl00_cphBeforeMiddleLeft_pnl00cphBeforeMiddleLeft_284" class="col-cms col-md-12 newsList">
                <div class="inner ">


                    <div id="" class="row">
                        @if(\Request::route()->getName() == 'home')
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $random_news[0] ])
                            </div>
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[6] ])
                            </div>

                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[7] ])
                            </div>

                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[8] ])
                            </div>
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[9] ])
                            </div>
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[10] ])
                            </div>
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $news_titr2[11] ])
                            </div>
                        @else
                            @foreach($NewsTitr2->fetch_titr2(5) as $val)
                            <div id="" class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                @include('fa.partial.one_news' , ['data'=> $val ])
                            </div>
                            @endforeach
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
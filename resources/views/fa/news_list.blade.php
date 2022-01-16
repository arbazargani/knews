@extends( App::getLocale().'.template')

@section('title', trans('custom.news_list') )

@section('content')
    <div style="clear:both;/*padding-top:130px;*/"></div>
    <div id="main_module_div_ajax">
        <div class="mainpage">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div style="clear: both"></div>
                        <h1 class="titlepage"> @lang('custom.newss')</h1>
                        <div style="clear: both"></div>
                        <div class="row">
                            @foreach($news as $val)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="boxuser">
                                        <div class="date" style="text-align:left;">
                                            {{ jDateTime::strftime('Y/m/d', strtotime($val->created_at)) }}
                                        </div>
                                        <a href="{{ route('news.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                            <img src="{{ image_url($val->image_url , 270,170,false) }}"
                                                 alt="{{ str_slug_fa($val->title) }}"
                                                 style="width: 100%; height: 178px;border-bottom:1px solid #B7B7B7"
                                                 title="{{ str_slug_fa($val->title) }}" class="">
                                        </a>
                                        <h3 style="font-weight:normal;margin:0px; padding:7px 15px;">
                                            <a href="{{ route('news.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                                {{$val->title}}
                                            </a>
                                        </h3>
                                        <div class="txt" style="padding:0 15px;text-align: justify">
                                            {!! mb_substr(strip_tags(html_entity_decode($val->descr, ENT_QUOTES, 'UTF-8')), 0, 165, 'UTF-8') !!}...
                                        </div>
                                        <p></p>
                                        <a class="more" href="{{ route('news.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                            @lang('custom.read_more')...
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination">
                                <div class="links">
                                    {{ $news->links() }}
                                </div>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


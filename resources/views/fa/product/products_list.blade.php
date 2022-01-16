@extends( App::getLocale().'.template')

@section('title', trans('custom.products_list') )

@section('content')
    <div style="clear:both;/*padding-top:130px;*/"></div>


    <div id="main_module_div_ajax">
        <div class="mainpage">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div style="clear: both"></div>
                        <h1 class="titlepage"> @lang('custom.products')</h1>
                        <div style="clear: both"></div>
                        <div class="row">
                            @foreach($products as $val)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="boxuser">
                                        {{--<div class="date" style="text-align:left;">
                                            {{ date('Y/m/d', strtotime($val->created_at)) }}
                                        </div>--}}
                                        <a href="{{ route('products.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                            <img src="{{ url( json_decode($val->imgs,true)[0]['file'] ) }}"
                                                 alt="{{ str_slug_fa($val->title) }}"
                                                 title="{{ str_slug_fa($val->title) }}" class="">
                                        </a>
                                        <h3>
                                            <a href="{{ route('products.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                                {{$val->title}}
                                            </a>
                                        </h3>
                                        <time class="blog-post-meta-date updated" datetime=" {{ date('Y-m-d h:i:s', strtotime($val->created_at)) }}">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            {{ jDateTime::strftime('Y M d ', strtotime($val->created_at)) }}
                                        </time>
                                        <div class="txt" >
                                            {!! mb_substr(strip_tags(html_entity_decode($val->descr, ENT_QUOTES, 'UTF-8')), 0, 165, 'UTF-8') !!}...
                                        </div>
                                        <p></p>
                                        <a class="more" href="{{ route('products.show',['id'=>$val->id , str_slug_fa($val->title) ]) }}">
                                            @lang('custom.read_more')
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination">
                                <div class="links">
                                    {{ $products->links() }}
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


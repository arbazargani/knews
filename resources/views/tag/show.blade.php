@extends('includes.template')

@section('title', 'خبر : '. $news->title)

@push('style')
{{--<link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=0.1') }}" type="text/css"/>--}}
<style>
    article.single-news .title, article.single-news .over-title {
        line-height: 1.2em;
        margin-bottom: 5px;
    }
    article.single-news .over-title  , article.single-news .under-title   {
        font-size: 1.2em;
    }
    article .under-title{
        line-height: 1.2em;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    article .over-title,.under-title, article .lead, article time, article .reporter {
        color: #5a5a5a;
        font-size: 1em;
        font-weight: normal;
    }
    article .over-title,.under-title, article .lead, article time, article .reporter {
        color: #5a5a5a;
        font-size: 1em;
        font-weight: normal;
    }
    article .title {
        clear: both;
        font-size: 1.7em;
        font-weight: bold;
    }
    article.single-news .title {
        font-size: 3.2rem;
    }
    article h1, article h2, article h3, article h4, article h5 {
        margin: 3px;
    }
    article.single-news .details, article.single-news .details .service {
        font-size: 1.1em;
        font-weight: bold;
    }
    article .details .service {
        color: #e84c3d;
    }
    article.single-news .details {
        margin-top: 10px;
        overflow: hidden;
    }
    article.single-news .details .service span {
        color: black;
        font-weight: normal;
        margin-left: 5px;
    }
    article.single-news .print {
        color: #5a5a5a;
        cursor: pointer;
        display: inline-block;
        float: left;
        font-size: 1.2em;
        vertical-align: top;
    }
    article.single-news .print i {
        color: #5a5a5a !important;
    }
    i.fa {
        vertical-align: middle;
    }
    article.single-news .details .service span {
        color: black;
        font-weight: normal;
        margin-left: 5px;
    }
    article.single-news figure {
        margin-top: 10px;
    }
    article figure {
        position: relative;
    }
    article figure img {
        margin-left: auto;
        margin-right: auto;
    }
    article.single-news time {
        font-size: 1em;
    }
    article .over-title, article .lead, article time, article .reporter {
        color: #5a5a5a;
        font-size: 1em;
        font-weight: normal;
    }
    time {
        display: block;
    }
    article.single-news .lead {
        color: black;
        font-size: 1.4em;
        margin: 15px 0;
        text-align: justify !important;
    }
    .lead {
        margin-bottom: 2px;
    }
    article .story {
        color: #404040;
        font-size: 18px;
        font-weight: 400;
        line-height: 24px;
        width: 100%;
    }
    article.single-news .story p {
        margin-bottom: 18px;
        text-align: justify;
    }
    article.single-news .article-footer {
        color: silver !important;
        font-size: 1.2em;
    }
    .share-box {
        margin-top: 30px;
        overflow: hidden;
    }
    .share-box header {
        display: inline-block;
        float: right;
        font-size: 1.9em;
        margin-left: 10px;
        margin-top: 3px;
    }
    .sharer {
        display: inline-block;
        float: right;
    }
    .well h2{
        padding: 0;
    }
</style>
@endpush

@section('content')

    <div tabindex="0" role="main" class="container" id="content">
        <h1 class="hide">Cardinal Theme</h1>
        <div class="row">
            <!-- Main column -->
            <div role="main" class="col-md-9" id="main-content">

                <section >
                    <article class="single-news">
                        <div class="well">
                            <h2 class="over-title">{{ $news->pre_title }}</h2>
                            <h1 class="title"> {{ $news->title  }}</h1>
                            <h2 class="under-title"> {{ $news->post_title }} </h2>
                            <div class="details">
                                <div class="service">
								<span class="print">
									<i class="fa fa-print" onclick="javascript:window.print();"></i>
								</span>
                                    {{--<span> شناسه خبر: 0101010101 </span>--}}
                                </div>
                                <time><i class="fa fa-clock-o"></i>
                                    {{ jDateTime::strftime('d F Y - H:i', strtotime($news->created_at)) }}
                                </time>
                            </div>
                        </div>

                        <div>
                            <figure>
                                <a href="{{ route('news.show',[ isset($subdomain)?($subdomain.'.'.$domain):$domain ,$news->_id , $news->title]) }}">
                                    <img class="img-responsive " alt="{{ $news->title }}"
                                         src="{{ ($news->image_url == '') ? image_url('/images/no_image.jpg',670,318) : image_url($news->user_id.'/'.$news->image_url,670,318 ,false) }}">
                                </a>
                            </figure>
                        </div>
                        <h3 class="lead">{{ $news->descr }}</h3>
                        <div class="story">
                            <p style="text-align: justify;">{!! $news->full_text  !!}</p>
                        </div>
                        <div class="article-footer"></div>
                        <div class="share-box">
                            <header> به اشتراک بگذارید:</header>
                            <div class="sharer">

                            </div>
                        </div>



                    </article>
                </section>
            </div>
            @include('includes.side')
        </div>
    </div>

@endsection

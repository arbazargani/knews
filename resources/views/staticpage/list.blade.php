@extends('includes.template')

@section('title', 'لیست اخبار')

@push('style')
<style>
    .well h2 {
        padding: 0;
    }

    .well {
        padding: 11px;
    }
    .news-container .content {
        overflow: hidden;
    }
    article.list-item {
        border-bottom: 1px solid #e3e3e3;
        margin-top: 5px;
        overflow: hidden;
        padding-top: 5px;
    }
    .vcenter {
        display: table-cell;
        float: none;
        margin-right: -4px;
        vertical-align: middle;
    }
    article.list-item figure {
        margin-left: 10px;
    }
    article figure {
        position: relative;
    }
    article figure img {
        margin-left: auto;
        margin-right: auto;
    }
    article .text-container {
        padding: 0;
    }
    article.list-item .over-title, article.list-item .lead {
        font-size: 1.1em;
    }
    article .over-title, article .lead, article time, article .reporter {
        color: #5a5a5a;
        font-size: 1em;
        font-weight: normal;
    }
    article h1, article h2, article h3, article h4, article h5 {
        margin: 3px;
    }
    article.list-item time, article.list-item .service {
        display: inline-block;
        float: left;
        font-size: 0.9em;
        font-weight: normal;
        margin-bottom: 7px;
        margin-right: 5px;
        min-width: 50px;
        text-align: center;
    }
    article.list-item time {
        display: inline-block;
        margin-left: 2px;
    }
    article .over-title, article .lead, article time, article .reporter {
        color: #5a5a5a;
        font-size: 1em;
        font-weight: normal;
    }
    time {
        display: block;
    }
    article time i, article .reporter i {
        font-size: 1em;
        margin-left: 2px;
    }
    i.fa {
        vertical-align: middle;
    }
    article.list-item .title {
        font-size: 1.3em;
        margin-bottom: 15px;
    }
    article .title {
        clear: both;
        font-size: 1.7em;
        font-weight: bold;
    }
    article h1, article h2, article h3, article h4, article h5 {
        margin: 3px;
    }
    .lead {
        margin-bottom: 2px;
    }

</style>
@endpush

@section('content')

    <div tabindex="0" role="main" class="container" id="content">
        <h1 class="hide">Cardinal Theme</h1>
        <div class="row">
            <!-- Main column -->
            <div role="main" class="col-md-9 " id="main-content" class="news-container">
                <div class="well">
                    <h2>لیست اخبار</h2>
                </div>

                <section class="content">

                   @foreach($news as $key=>$val)
                    <article class="list-item">
                        <a target="_blank" href="{{ route('news.show',[ $domain , $val->_id , $val->title ]) }} ">
                            <div class="col-xs-3 image-container vcenter ">
                                <figure>
                                    <img class="img-responsive " alt="{{ $val->title }}" src="{{ ($val->image_url == '') ? image_url('/images/no_image.jpg',170,118) : image_url($val->image_url,170,118) }}">
                                </figure>
                            </div>
                            <div class="col-xs-9 text-container vcenter ">
                                <h2 class="over-title ">
                                    <time><i class="fa fa-clock-o"></i> ۰۳ تير ۱۳۹۵ - ۰۵:۳۶</time>
                                    {{ $val->pre_title }}
                                </h2>
                                <h1 class="title">{{ $val->title }}</h1>
                                <h3 class="lead">
                                    {{ $val->descr }}
                                </h3>
                            </div>
                        </a></article>
                   @endforeach

                </section>

            </div>
            @include('includes.side')
        </div>
    </div>

@endsection

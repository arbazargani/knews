@extends('layouts.app')
@push('style_lib')
<link href="{{ asset('assets/plugins/bootstrap_3.3.6/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
    .mb15 , strong{
        color: #ff0000;
    }
</style>
@endpush

@section('title',  ' - ' . $cat[0]['title_fa'] . ' / ' . $cat[0]['title_en'] )


@section('content')

    <section class="container clearfix" id="content" style="min-height: 270px;">

        <header class="page-header">
            <h1 class="page-title"> {{ $cat[0]['title_fa'] . ' / ' . $cat[0]['title_en'] }}</h1>
            <h2 style="font-size: 20px"> {{ $cat[0]['descr'] }} </h2>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-4" style="padding-right: 0px">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <section>
                                @foreach($courses as $key=>$course)
                                    @if($key%2 != 0)
                                        @continue;
                                    @endif
                                    <article class="entry clearfix" style="width: 100%;overflow: hidden">
                                        <a title="" href="{{ route('course',[$course->id , $course->title]) }}">
                                            <img style="width: 100%; height: 250px ;" class="entry-image" alt="{{ json_decode($course->imgs,true)[0]['caption'] }}" src="{{ json_decode($course->imgs,true)[0]['file'] }}">
                                        </a>
                                        <div class="entry-body">
                                            <a href="{{ route('course',[$course->id , $course->title]) }}">
                                                <h1 class="title">{{ $course->title }}</h1>
                                            </a>
                                            <p>{{ $course->descr }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="padding-right: 0px">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <section>
                                @foreach($courses as $key=>$course)
                                    @if($key%2 == 0)
                                        @continue;
                                    @endif
                                    <article class="entry clearfix">
                                        <a title="" href="{{ route('course',[$course->id , $course->title]) }}">
                                            <img style="width: 100%;height: 250px ;" class="entry-image" alt="{{ json_decode($course->imgs,true)[0]['caption'] }}" src="{{ json_decode($course->imgs,true)[0]['file'] }}">
                                        </a>
                                        <div class="entry-body">
                                            <a href="{{ route('course',[$course->id , $course->title]) }}">
                                                <h1 class="title">{{ $course->title }}</h1>
                                            </a>
                                            <p>{{ $course->descr }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div>

            </div>
        </div>

    </section>

@endsection

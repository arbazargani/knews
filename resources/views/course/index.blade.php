@extends('layouts.app')
@push('style_lib')
<link href="{{ asset('assets/plugins/bootstrap_3.3.6/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
    .mb15 {
        color: #ff0000;
    }
</style>
@endpush

@section('title',  ' - ' .$course->title  )

@section('content')

    <section class="container clearfix" id="content" style="min-height: 270px;">

        <header class="page-header">
            <h1 class="page-title">{{ $course->title }}</h1>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-8" style="padding-right: 0px">
                    <div class="panel panel-default">

                        <div class="panel-body">

                            <section>
                                <article class="entry single clearfix">
                                    <div class="image-gallery-slider">
                                        <ul>
                                            @foreach( json_decode($course->imgs,true) as $val )
                                                <li>
                                                    <a href="{{ route('course',[$course->id , $course->title]) }}">
                                                        <img style="height: 260px" src="{{ url($val['file']) }}" alt="{{ url($val['caption']) }}"
                                                             class="entry-image">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="entry-body">

                                        <a href="{{ route('course',[$course->id , $course->title]) }}">
                                            <h1 class="title">{{ $course->title }}</h1>
                                        </a>

										@if(!empty($course->video))
                                            <div style="text-align: center">
												<a style="font-size:15px" href="{{ url($course->video) }}"> دانلود فیلم آموزشی </a>
												<br/>
												<video width="100%" height="350" controls>
												  <source src="{{ url($course->video) }}" type="video/mp4">
												  Your browser does not support the video tag.
												  
												<object width="450" height="350" id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">
                                                    <param name="movie" value="{{ url('assets/media/player.swf') }}">
                                                    <param name="allowfullscreen" value="true">
                                                    <param name="allowscriptaccess" value="always">
                                                    <param name="flashvars" value="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">
                                                    <embed width="450" height="350" type="application/x-shockwave-flash" id="player2" name="player2" src="{{ url('assets/media/player.swf') }}" allowscriptaccess="always" allowfullscreen="true" flashvars="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">
                                                </object>
												  
												</video> 
                                                <!--<object width="450" height="350" id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">
                                                    <param name="movie" value="{{ url('assets/media/player.swf') }}">
                                                    <param name="allowfullscreen" value="true">
                                                    <param name="allowscriptaccess" value="always">
                                                    <param name="flashvars" value="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">
                                                    <embed width="450" height="350" type="application/x-shockwave-flash" id="player2" name="player2" src="{{ url('assets/media/player.swf') }}" allowscriptaccess="always" allowfullscreen="true" flashvars="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">
                                                </object>-->
                                            </div>
                                        @endif

                                        @if(!empty($course->audio))
                                            <object width="400" height="20" data="{{ url('assets/media/player_mp3.swf') }}" type="application/x-shockwave-flash">
                                                <param value="{{ url('assets/media/player_mp3.swf') }}" name="movie">
                                                <param value="#ffffff" name="bgcolor">
                                                <param value='mp3={{ url($course->audio) }}&amp;loop=0&amp;showvolume=1&amp;showstop=1&amp;' name="FlashVars">
                                            </object>
                                        @endif
										
                                        <p>
                                            {!!  $course->fulltext  !!}
                                        </p>

                                        </p>

                                        @if(!empty($course->files))
                                        <ul>
                                            <li style="font-size: 16px">فایل های پیوست</li>
                                            @foreach( json_decode($course->files , true )as $key=>$val)
                                            <li style="font-size: 16px"><a href="{{ url($val) }}"> دانلود فایل پیوست {{ $key + 1 }}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif

                                        

                                        <br/>
                                        <br/>


                                    </div>

                                </article>
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

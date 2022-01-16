@extends(App::getLocale().'.profile.main')

@section('title', $course->title   )

@section('profile_content')


    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">
                <div style="clear: both"></div>
                <h1 class="">
                    {{ $course->title }}
                </h1>
                <div style="clear: both"></div>

                <div class="col-md-12">
                    <div class="row">
                        <p>
                            {!! $course->fulltext !!}
                        </p>
                    </div>
                    @if($course->video != '')
                        <div class="row">
                            <p style="text-align: center">
                                <object width="450" height="350" id="player"
                                        classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">
                                    <param name="movie" value="{{ url('assets/media/player.swf') }}">
                                    <param name="allowfullscreen" value="true">
                                    <param name="allowscriptaccess" value="always">
                                    <param name="flashvars"
                                           value="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">
                                    <embed width="450" height="350" type="application/x-shockwave-flash"
                                           id="player2" name="player2"
                                           src="{{ url('assets/media/player.swf') }}" allowscriptaccess="always"
                                           allowfullscreen="true"
                                           flashvars="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">
                                </object>
                            </p>
                        </div>
                    @endif
                    @if($course->audio != '')
                        <div class="row">
                            <p style="text-align: center">
                                <object width="400" height="20" data="{{ url('assets/media/player_mp3.swf') }}"
                                        type="application/x-shockwave-flash">
                                    <param value="{{ url('assets/media/player_mp3.swf') }}" name="movie">
                                    <param value="#ffffff" name="bgcolor">
                                    <param value='mp3={{ url($course->audio) }}&amp;loop=0&amp;showvolume=1&amp;showstop=1&amp;'
                                           name="FlashVars">
                                </object>
                            </p>
                        </div>
                    @endif
                    @if($course->files != '')
                        <div class="row">
                            <p>
                            <ul style="list-style: unset">
                                @foreach( json_decode($course->files , true) as $key=>$val )
                                    <li style="margin-bottom: 5px;">
                                        <a style="width: 10%; height: 10%;" snattr="{{ $val }}" href="{{ $val }}"> دانلود فایل پیوست {{ $key + 1 }} </a>
                                    </li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    @endif

                    @if($course->imgs != '')
                        @php
                            $imgs = json_decode($course->imgs ,true) ;
                        @endphp
                        <div style="padding-bottom: 40px;" class="col-xs-12 col-sm-12 col-md-12 ">
                            <div class="row">
                                <div style="text-align: center;"  class="col-xs-12">
                                    <img style="width: 100% ;height: auto"  class="block_product_image image_5899eb0fc5344 img-responsive img-thumbnail align_center"
                                         alt="{{ str_slug_fa($imgs[0]['caption'] , ' ') }}" src="{{ url($imgs[0]['file']) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    @foreach($imgs as $key=>$val)
                                        <div style="text-align: center;cursor: pointer" class="block_product_thumb thumb_5899eb0fc5344 col-xs-2">
                                            <img class="img-responsive img-thumbnail"
                                                 alt="{{ str_slug_fa($val['caption'] , ' ') }}" src="{{ url($val['file']) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>


            </div>
        </div>
    </div>

@endsection

@push('script_bottom')
<script>
    $(document).ready(function () {
        $(".thumb_5899eb0fc5344 img").click(function (e) {
            var main_image = $(".image_5899eb0fc5344");
            main_image.attr('src', $(this).attr("src"));
            main_image.attr('alt', $(this).attr("alt"));
            main_image.attr('title', $(this).attr("title"));
        });
    });
</script>
@endpush

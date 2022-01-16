@extends( App::getLocale().'.template')

@section('title', $product->title  )

@section('content')
    <div style="clear:both;/*padding-top:140px;*/"></div>

    <div id="main_content">


        <div class="block_container"
             style="margin-bottom: 50px;border-bottom-width: 1px;border-bottom-color: #cccccc;border-bottom-style: dashed;">
            <div class="container-fluid" style="padding-left: 40px;padding-right: 40px;">
                <div class="row">

                    @php
                    $imgs = json_decode($product->imgs ,true) ;
                    @endphp
                    <div style="padding-bottom: 40px;" class="col-xs-12 col-sm-6 col-md-4 col-md-offset-1">
                        <div class="row">
                            <div class="col-xs-12">
                                <img style="height: 480px;" class="block_product_image image_5899eb0fc5344 img-responsive img-thumbnail align_center"
                                     alt="{{ str_slug_fa($imgs[0]['caption'] , ' ') }}" src="{{ url($imgs[0]['file']) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                @foreach($imgs as $key=>$val)
                                <div class="block_product_thumb thumb_5899eb0fc5344 col-xs-3">
                                    <img class="img-responsive img-thumbnail"
                                         alt="{{ str_slug_fa($val['caption'] , ' ') }}" src="{{ url($val['file']) }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 40px;" class="col-xs-12 col-sm-6 col-md-6">
                        <div class="block_title ">
                            <h3 style="font-size: 22px;">{{ $product->title }}</h3>
                        </div>
                        <div class="block_body align_justify" style="">
                            {!! $product->descr !!}
                            <br/>
                            @if($product->video != '')
                                <br>
                                <div class="row">
                                    <p style="text-align: center">
                                        <object width="450" height="350" id="player"
                                                classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">
                                            <param name="movie" value="{{ url('assets/media/player.swf') }}">
                                            <param name="allowfullscreen" value="true">
                                            <param name="allowscriptaccess" value="always">
                                            <param name="flashvars"
                                                   value="file={{ url($product->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">
                                            <embed width="450" height="350" type="application/x-shockwave-flash"
                                                   id="player2" name="player2"
                                                   src="{{ url('assets/media/player.swf') }}" allowscriptaccess="always"
                                                   allowfullscreen="true"
                                                   flashvars="file={{ url($product->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">
                                        </object>
                                    </p>
                                </div>
                            @endif
                            @if($product->audio != '')
                                <br>
                                <div class="row">
                                    <p style="text-align: center">
                                        <object width="400" height="20" data="{{ url('assets/media/player_mp3.swf') }}"
                                                type="application/x-shockwave-flash">
                                            <param value="{{ url('assets/media/player_mp3.swf') }}" name="movie">
                                            <param value="#ffffff" name="bgcolor">
                                            <param value='mp3={{ url($product->audio) }}&amp;loop=0&amp;showvolume=1&amp;showstop=1&amp;'
                                                   name="FlashVars">
                                        </object>
                                    </p>
                                </div>
                            @endif
                            @if($product->files != '')
                                <br>
                                <div class="row">
                                    <p>
                                    <ul>
                                        @foreach( json_decode($product->files , true) as $key=>$val )
                                            <li style="margin-bottom: 5px;">
                                                <i class="fa fa-tags"></i>
                                                <a style="width: 10%; height: 10%;" snattr="{{ $val }}" href="{{ $val }}"> @lang('custom.download_attachment') {{ $key + 1 }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    </p>
                                </div>
                            @endif
                            {{--<div class="row" style="margin: auto;text-align: center">
                                @if($product->price == 0)
                                    <a href="{{ route('contactus') }}">
                                        @lang('custom.plz_call_me')
                                    </a>
                                @else
                                    <strong style="margin: 50px">
                                        @lang('custom.prices') : {{ $product->price }} @lang('custom.rial')
                                    </strong>
                                    <a href="{{ route('peyment.product',[$product->id]) }}" class="">
                                        <button style="width: 200px" class="btn btn-warning" type="button" name="en">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            @lang('custom.buy')
                                        </button>
                                    </a>
                                @endif
                            </div>--}}
                        </div>

                    </div>

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

                </div>
            </div>
        </div>


        <div class="block_container" bid="45" btid="186" style="">
            <div class="container-fluid" style="padding-left: 40px;padding-right: 40px;">
                <div class="row">

                    <div style="padding-bottom: 40px;"class="block_column col-xs-12 col-sm-11 col-md-12">
                        {!! $product->fulltext !!}
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection


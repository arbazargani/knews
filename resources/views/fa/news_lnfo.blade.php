@extends( App::getLocale().'.template')

@section('title', $news->title  )

@section('content')
    <div id="" class=" col-xs-12">
        <div id="" class="row row531">
            <div id="ctl00_cphBeforeMiddleRight_pnl00cphBeforeMiddleRight_132"
                 class="col-cms col-md-12 newsSlider dateStyle" style="padding-right: 0">
                <div class="inner ">
                    <div class="panel panel-style2 ">
                        <div class="">
                            <div id="ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlMain"
                                 class="lightSliderWrapper noPrint">

                                <div class="sliderItemContainer" style="margin-top: 16px">

                                    <div class="sliderInformation"><p class="sliderTitle"><a
                                                    href="{{ route('news.show', [$news->id , str_slug_fa($news->title)]) }}"
                                                    target="_blank">{{ $news->title }}</a></p>
                                        <div class="sliderDate"
                                             style="width:620px">{{ jDate::forge($news->created_at)->format('%d %B %Y') }}</div>
                                    </div>

                                    @if($news->type == 'titr1')
                                    <a href="{{ route('news.show', [$news->id , str_slug_fa($news->title)]) }}"
                                       target="_blank" style="" class=" sliderLink"
                                       data-fancybox-group="ctl00_cphBeforeMiddleRight_Sampa_Web_View_NewsUI_NewsSliderControl00cphBeforeMiddleRight_132_lsItemSlider_pnlMain">
                                        <h3 style="margin-top: 0px;padding:0px !important; "
                                            class="lightSliderImageWrapper ">
                                            <img class="sliderImage "
                                                 src="{{ image_url($news->image_url , 455,290 ,true) }}"
                                                 alt="{{ str_slug_fa($news->title) }}"
                                                 title="{{ str_slug_fa($news->title) }}"
                                                 style="height:290px;width: 455px"/>
                                        </h3></a>
                                    @endif
                                    <div class="sliderInformations">
                                        <p style="font-weight: bold ; color: #666666;font-size: 12px !important; " class="lead">
                                            {!! $news->descr !!}
                                        </p>
                                        <p>
                                            @php
                                                /*
                                                * to handle ssl loading for iframes source.
                                                * this is because we dont want to change any database values by hand.
                                                * consider that the main content is available through $news->full_text
                                                */
                                                $content = str_replace('scrolling="no" src="http://www.ketabnews.com/files/video', 'scrolling="no" src="https://www.ketabnews.com/files/video', $news->full_text);
                                            @endphp
                                            <!--{!! $news->full_text !!}-->
                                            {!! $content !!}
                                        </p>
                                    </div>
                                    <div class="socialnetwork">

                                        {{--<div><a href="#" class="glyphicon glyphicon-Magnifier searchToggle">asd</a>--}}
                                        {{--</div>--}}


                                        <div style="margin-bottom:5px">
                                            <!--
                                            <a href="whatsapp://send?text={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}" data-action="share/whatsapp/share" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="color: green" type="button" role="button"><i
                                                        class="fab fa-whatsapp"></i></a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}&title={{ str_slug_fa($news->title) }}"
                                                    class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="color: #0274b6" type="button" role="button"><i
                                                        class="fab fa-linkedin-in"></i></a>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}"
                                               class="btn-floating btn-lg btn-fb waves-effect waves-light"
                                               style="color: #0274b6" type="button" role="button"><i style="font-size: 17px"
                                                        class="fab fa-facebook-f"></i></a>
                                            <a href="https://twitter.com/intent/tweet?text={{ str_slug_fa($news->title) }}&url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}"
                                                    class="btn-floating btn-lg btn-tw waves-effect waves-light"
                                               style="color: #01aaed" type="button" role="button"><i
                                                        class="fab fa-twitter"></i></a>
                                            <a href="https://telegram.me/share/url?url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}&text={{ str_slug_fa($news->title) }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="color: #0189cd" type="button" role="button"><i
                                                        class="fab fa-telegram"></i></a>
                                            <a href="{{ route('contactus') }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="color: #0189cd" type="button" role="button"><i
                                                        class="fas fa-envelope"></i></a>
												-->		
											<a href="https://telegram.me/share/url?url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}&text={{ str_slug_fa($news->title) }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:24px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: 4px;
											   " type="button" role="button"></a>		


											<a href="whatsapp://send?text={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}" data-action="share/whatsapp/share" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:21px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: -24px;
											   " type="button" role="button"></a>		



											<a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}&title={{ str_slug_fa($news->title) }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:21px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: -48px;
											   " type="button" role="button"></a>


											<a href="https://www.facebook.com/sharer/sharer.php?u={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:21px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: -73px;
											   " type="button" role="button"></a>											   

											<a href="https://twitter.com/intent/tweet?text={{ str_slug_fa($news->title) }}&url={{ route('news.show',[$news->id , str_slug_fa($news->title)]) }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:21px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: -98px;
											   " type="button" role="button"></a>											   

											<a  href="{{ route('contactus') }}" class="btn-floating btn-lg btn-li waves-effect waves-light"
                                               style="
											       background-image: url(http://www.ketabnews.com/social.png);
													background-repeat: no-repeat;
													background-size: 150px;
													padding-right:21px;
													width: 24px;
													height: 22px;
													color: rebeccapurple;
													background-position: -123px;
											   " type="button" role="button"></a>											   

                                        </div>


                                    </div>

                                </div>


								<div id="" class="col-cms col-lg-12 col-md-12 customNewsList titleCount margin-bottom-20" style=" border-bottom: 2px solid;padding-bottom: 7px;">                                								
									<div class="inner">
                                        <div id="" class="row">
											@foreach($tags as $val)
												<a style="font-size: 10px" id=""
												   title="{{ jDate::forge($val->created_at)->format('%d %B %Y') }}"
												   href="{{ route('tag.show',[$val->id , str_slug_fa($val->title)]) }}"
												   target="_parent">{{ $val->title }}</a>
												| 
											@endforeach
										</div>
									</div>
								</div>


                                <div id=""
                                     class="col-cms col-lg-12 col-md-12 customNewsList titleCount padding-bottom-20 margin-bottom-20">
                                    
									
									<div class="inner">
                                        <div id="" class="row">
                                            @foreach($news_related as $val)
                                                <div id=""
                                                     class="newsContainer newsListWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="newsListItem">
                                                        <div id="" class="newsListTitle">
                                                            <h3>
                                                                <a id=""
                                                                   title="{{ jDate::forge($news->created_at)->format('%d %B %Y') }}"
                                                                   href="{{ route('news.show',[$val->id , str_slug_fa($val->title)]) }}"
                                                                   target="_parent">{{ $val->title }}</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
<header class="mainHeaderWrap">
    <div class="adminBarWrap">


    </div>
    <div class="container">
        <div class="row headerTop">
            <div class="col-md-10 col-md-offset-1 col-lg-np col-md-np col-xs-12 noInnerRowMargin">
                <div id="" class=" ">
                    <div id="" class="row row524">
                        <div class="col-md-9" style="padding-right: 11px ;padding-left: 11px">

                            <div class="row">

                                <div class="col-md-12" style="padding: 0px">
                                    <div class="content">
                                        <?php
                                        $adstop = \App\Ads::where('status', 'active')->where('location', 'top')->where('lang', \App::getLocale())->orderBy('created_at', 'Desc')->first();
                                        ?>
                                        @if(!empty($adstop))
                                            <a target="_blank"
                                               href="{{ route('ads.click',$adstop->id) }}"
                                               rel="nofollow">
                                                <img class="center-block img-responsive" style="border-width: 0px;border-style: solid;padding-top: 23px;width: 100%;margin: 0;" alt="{{ $adstop->title }}"
                                                     src="{{ url('files/'.$adstop->image_url ) }}"/>
                                            </a>
                                        @else
                                            <a target="_blank"
                                               href="#"
                                               rel="nofollow">
                                                <img class="center-block img-responsive" style="border-width: 0px;border-style: solid;padding-top: 23px;width: 100%;margin: 0;" alt="ads"
                                                     src="{{ image_url( '154788557294558563.jpg'  , 0,0,false) }}"/>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">                                
                                <div id="" class="headerMiddle headerMatchHeight col-md-push-1 col-lg-npl col-md-11 col-md-npl  col-sm-11 col-xs-11" style="padding-right: 0px;height: 49px;z-index: 100000;">
                                    <div id="" class="row row526">
                                        <div id="" class="col-cms col-lg-npl col-lg-npr col-md-npl col-md-npr col-sm-npl col-sm-npr col-xs-npl col-xs-npr ">
                                            <div class="inner ">
                                                <div id="" class="noPrint">
                                                    <div id="" class="mainMenu">
                                                        <div id="" class="menu3dmega">
                                                            <ul>
                                                                <li>
																	<a style="padding-right: 2px" href="{{ url('tags/151/رمان-خارجی') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >رمان خارجی</span></a>
                                                                </li>
                                                                
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/152/داستان-کوتاه') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >داستان کوتاه</span></a>
                                                                </li>
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/153/تاریخ-و-سیاست') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >تاریخ</span></a>
                                                                </li>
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/154/دین-و-فلسفه') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >دین و فلسفه</span></a>
                                                                </li>
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/223/مدیریت-و-اقتصاد') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >اقتصاد</span></a>
                                                                </li>
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/230/روانشناسی-و-حقوق') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >روانشناسی</span></a>
                                                                </li>
                                                                 <li>
																	<a style="padding-right: 2px" href="{{ url('tags/149/شعر-و-ادبیات-کهن') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >شعر</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px" href="{{ url('tags/141/کودک-و-نوجوان') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >کودک و نوجوان</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px" href="{{ url('tags/421/طرح-روی-جلد') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >طرح جلد</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px" href="{{ url('tags/465/فیلم-و-تصویر') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >فیلم</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px" href="{{ url('tags/419/طنز-و-کاریکاتور') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff" >طنز</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px;" href="{{ route('tag.list') }}" class="first">
                                                                        <span style="padding-left: 2px; border-left:1px solid #fff">ریشه‌ها</span></a>
                                                                </li>
                                                                <li>
																	<a style="padding-right: 2px;" href="{{ route('tag.show',[1,'پساکتاب']) }}" class="first">
																	<span>پس از کتاب</span></a>
																</li>                                                               
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="" style="padding-left: 0px;" class="headerRight headerMatchHeight col-md-1 col-md-pull-11  col-sm-1 col-xs-1 col-xs-npl col-xs-npr">
                                    <div id="" class="row row525">
                                        <div id="" class="col-cms col-md-2 col-sm-npl col-sm-npr col-xs-12 customSearchIcon">
                                            <div class="inner ">
                                                <div class="content">
                                                    <div style="margin-top: -5px;margin-right: -29px;"><a href="#" class="glyphicon glyphicon-Magnifier searchToggle"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="" class="col-cms col-lg-4 col-sm-6 col-xs-6 customSearch">
                                            <div class="inner ">
                                                <div id="" class="googleSearchBoxWrap">

                                                    <div class="form-inline generalSearchBox noPrint">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <form id="fsearch" action="{{ route('search','') }}" method="get">
                                                                    <input name="q" type="text" id="q" class="text form-control"/>                                                                
																	<div class="input-group-btn">
																		<a id="a-btn-search" class="btn btn-default">
																			<i class="glyphicon glyphicon-search"></i>
																		</a>
																	</div>
																</form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                        {{--<div id="ctl00_cphHeader_cphHeaderRight_pnl02cphHeaderRight_128" class="col-cms col-lg-npl col-lg-npr col-md-npl col-md-npr col-sm-10 hidden-sm hidden-xs headerImage">--}}
                                        {{--<div class="inner ">--}}

                                        {{--<div class="content"><img src="images/5_orig.png" alt="کتاب نیوز 5" class="center-block img-responsive" style="border-width: 0px; border-style: solid;"/></div>--}}
                                        {{----}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="" class="headerLeft headerMatchHeight col-md-3 col-xs-12">
                            <div id="" class="row row527">
                                <div id="" style="" class="divmainlogo col-cms col-lg-npl col-md-10 col-md-offset-1 col-md-npl col-sm-12 col-sm-offset-0 col-xs-6 col-xs-offset-3 ">
                                    <div class="inner ">
                                        <a id="" title="{{ config('app.name') }}" class="mainLogoLink" href="{{ url('/') }}">
                                            <!--6_orig.png-->
                                            <img id="" class="img-responsive mainLogoImage" src="{{ url('images/7_orig-new.png') }}" alt="{{ config('app.name') }}" style="border-width:0px;"/></a>
                                        <span id="" class="h5 mainLogoDescription"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
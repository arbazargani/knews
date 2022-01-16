<footer class="mainFooterWrap">
    <div class="container-fluid noBackgroundInPrint">
        <div class="row">
            <div id="" class=" container-fluid ">
                <div id="" class="row row523">
                    <div id="" class="footerTop col-md-10 col-md-offset-1 col-xs-12">
                        <div id="" class="row row528">
                            <div id="" class="col-cms col-md-12 ">
                                <div class="inner ">

                                    <style>
                                        .mainFooterWrap .mainLogoImage{
                                            padding: 0;
                                        }
                                        .footer-link a{
                                            color: #000;
                                        }
                                        .footer-link {
                                            top: 5px;
                                        }
                                        .footer-link > .rss{
                                            padding-right: 20px;
                                            padding-left: 35px;
                                        }
                                        .footer-link > .archive , .contactus{
                                            padding-left: 15px;
                                        }
                                        .aboutus{
                                            padding-left: 92px;
                                        }
                                        .mainLogoImage{
                                            border-width:0px;    margin-right: 0;
                                        }
                                        @media(min-width:992px){
                                            .divmainlogo{
                                                margin-right: 8px;
                                            }
                                        }
                                        @media(max-width:992px){
                                            .mainLogoImage{
                                                width: 200px;
                                                margin: 0 auto;
                                                padding-top: 10px;
                                            }
                                            .copyright{
                                                text-align: center;
                                            }
                                        }
                                        @media(max-width:768px){
                                            .mainLogoImage{
                                                width: 200px;
                                                margin: 0 auto;
                                                padding-top: 10px;
                                            }
                                            .copyright{
                                                text-align: center;
                                            }

                                        }
                                    </style>
                                    <nav class="footerNav noPrint">

                                        <div id="" class="linearFooter">

                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-3 col-md-offset-2 footer-link">
                                                    <a style="color: #186975" class="archive"  href="{{ route('archive') }}">آرشیو</a>
                                                    {{--<a class="contactus"  href="{{ route('contactus') }}">ارتباط با ما</a>--}}
                                                    <a style="color: #186975" class="rss"  rel="alternate" type="application/atom+xml" target="_blank" href="{{ url('rss') }}">RSS</a>
                                                    <a style="color: #186975" class="aboutus"  href="{{ route('aboutus') }}">درباره ما</a>
                                                </div>

                                                <div class="col-md-2" style="border-right: 2px solid black;margin-right: -83px;">
                                                    <a style=" padding: 0;  margin: 0; " id="" title="کتاب نیوز"
                                                       class="mainLogoLink" href="#">
                                                        <img id="" class="img-responsive mainLogoImage"
                                                             src="{{ url('images/4_orig.png') }}" alt="کتاب نیوز"
                                                             style=""/>
                                                    </a>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>

                                        </div>

                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="" class="placeHolderWrapper" style="background:url({{ url('images/14_orig.png') }});">
                        <div id="" class="footerBottom col-xs-12">
                            <div id="" class="row row529">
                                <div id="" class="col-cms col-md-12 ">
                                    <div class="inner ">

                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-3 col-md-offset-2 copyright" style="padding-right: 45px;color: #fff;font-size: 10px" >
کلیه حقوق متعلق است به
                                                <a style="color: #fff;" href="{{ url('/') }}">کتاب نیوز</a>
                                                .
                                            </div>

                                            <div class="col-md-2" style="border-right: 2px solid black;margin-right: -18px;">
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>




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
</footer>
@inject('ads', 'App\Libraries\AdsInject')
<style>
    .advertiseRow{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
</style>
<aside class="col-xs-12 col-sm-12 col-md-3 col-sm-npr leftColumn">
    <div id="" class=" col-lg-npl col-lg-npr col-md-npl col-md-npr col-xs-12">
        <div id="" class="row row518">
            <div id="" class=" ">
                <div id="" class="row row609">
                    <div id="" class="col-cms col-xs-12 ">
                        <div class="inner ">
                            <div id="" class="advertisement advertisementList" style="margin-top: 14px">

                                @foreach($ads->fetch() as $key=>$val)
                                    <div id="" class="advertiseRow col-lg-12 col-md-12 col-sm-4 col-xs-12">
                                        <div id="" class="advertiseColumn">
                                            <div id="" class="bannerAdvertisement">
                                                <div id="" class="imageAdvertisementList">
                                                    <a target="_blank"
                                                       href="{{ route('ads.click',$val->id) }}"
                                                       rel="nofollow">
                                                        <img style="margin-bottom:5px;width: 100%;height: 100%" class="img-responsive" alt="{{ $val->title }}"
                                                             src="{{  url('files/'.$val->image_url)  }}"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="" class="clearBoth hidden-xs hidden-sm hidden-md">
                                    </div>
                                @endforeach


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>


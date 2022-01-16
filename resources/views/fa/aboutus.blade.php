@extends( App::getLocale().'.template')

@section('title', trans('custom.aboutus')  )

@section('content')
    <div style="clear:both;/*padding-top:80px;*/"></div>
    <div id="main_module_div_ajax">
        <div class="mainpage">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-offset-0 col-sm-12 col-xs-12">
                        <div style="clear: both"></div>

                        <div class="sliderInformation" style="padding-right: 20px; border-right: 3px solid #f18c19; margin-top: 16px; ">
                            <p class="sliderTitle">
                                <a target="_blank"> @lang('custom.aboutus')</a>
                            </p>
                        </div>


                        <div style="clear: both"></div>
						<div>
							<p>
								{!! $aboutus->fulltext !!}
							</p>
						</div>
                        
                        <div style="clear:both"></div>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<Style>
	pre
	{
		overflow-x: hidden; 
		overflow-y: auto;		
		margin-left: 12px !important;
	}
	pre > img {
		width: 100%;
	}
	</Style>
@endsection
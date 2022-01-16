@extends( App::getLocale().'.template')

@section('title', $title )

@section('content')

    <section class="content-top">
        <div class="container">
            <div class="row" style="padding-right: 15px; padding-left: 15px;">
                <div id="content" class="col-sm-12">
                    <div class="form-group">
                        <article class="article-info">
                            <div class="article-description">
                                <div class="row">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0"
                                                class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @foreach(json_decode($slider_company->slider ,true ) as $key=>$val)
                                                <div class="item @if($key == 0) active @endif">
                                                    <img src="{{ url('files').'/'. $val }}"
                                                         alt="{{ str_slug_fa($slider_company->company_name) .' - '. str_slug_fa($slider_company->brand)  }}">
                                                    <div class="carousel-caption"></div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button"
                                           data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box latest">
                        <div class="box-heading">
                            <h3>@lang('custom.last_products')</h3>
                        </div>
                        <div class="box-content">
                            <div class="row">
                                @foreach($plist as  $val)
                                    <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        @include(App::getLocale().'.big_box_product' , [ 'data' => $val ])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">{{ $plist->links() }}</div>
            </div>


        </div>
    </section>

@endsection
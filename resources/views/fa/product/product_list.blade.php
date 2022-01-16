@extends( App::getLocale().'.template')

@section('title', trans('custom.products_list') . ' - ' . $pc->title  )

@section('content')
    <section class="content-top">
        <div class="container">
            <div class="row">

                @include(App::getLocale().'.cat')

                <div id="content" class="col-sm-9"> <h3>{{ $pc->title }}</h3>
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ url('files'.'/'.$pc->image_url) }}" alt="{{ str_slug_fa($pc->title) }}" title="{{ str_slug_fa($pc->title)}}" class="img-thumbnail" width="270" height="264">
                        </div>
                        <div class="col-sm-9">
                            <p>{!! $pc->descr !!}</p>
                        </div>
                    </div>
                    <hr>
                    {{--<div class="product-filter clearfix">
                        <div class="product-filter_elem">
                            <div class="button-view">
                                <button type="button" id="list-view" data-toggle="tooltip" title="" data-original-title="@lang('custom.list')" class=""><i class="material-design-view12"></i></button>
                                <button type="button" id="grid-view" data-toggle="tooltip" title="" class="active" data-original-title="@lang('custom.grid')"><i class="material-design-two375"></i></button>
                            </div>
                        </div>
                    </div>--}}
                    <div class="row">
                        @foreach($prod as  $val)
                            <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                @include(App::getLocale().'.big_box_product' , [ 'data' => $val ])
                                <div class="clear"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left"></div>
                        <div class="col-sm-6 text-right">{{ $prod->links() }}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@push('style')
<link href="{{ url('assets/css/products.css') }}" rel="stylesheet">
@endpush
@push('script_middle')
<script src="{{ url('assets/js/jquery.elevatezoom.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/jquery.bxSlider.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/jquery.fancybox.js') }}" type="text/javascript"></script>
@endpush
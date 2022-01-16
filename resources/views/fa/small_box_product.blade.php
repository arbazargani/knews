<div class="product-thumb transition row options">
    <div class="col-xs-6">
        <div class="image">
            <a href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}">
                <img width="170" height="164" alt="{{ str_slug_fa($data->product_name , ' ') }}"
                     title="{{ str_slug_fa($data->product_name , ' ') }}" class="img-responsive"
                     src="{{ url('files').'/'. json_decode($data->file_url , true)[0] }}"/>
            </a>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="caption">
            <div class="name">
                <a href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}">{{ $data->product_name }}</a>
            </div>
            <div class="price">
                {{--<span class="price-old">32000 تومان</span><br/>--}}
                <span class="price-new">
                    {{ $data->prices }}
                    @lang('custom.prices_currency_val.'.$data->prices_currency )
                    @lang('custom.at')
                    @lang('custom.amount_val.'.$data->prices_unit )
                </span>
            </div>
            <div class="btn-icon">
                <button class="btn" type="button">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@lang('custom.view_order')</span>
                </button>
            </div>
        </div>
    </div>
</div>
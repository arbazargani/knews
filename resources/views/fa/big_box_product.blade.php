<div class="product-thumb transition options">
    <div class="image">
        @php
            $imgf = json_decode($data->file_url , true);
        @endphp
        <a class="lazy" style="padding-bottom: 97.777777777778%" href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}">
            <img alt="{{ str_slug_fa($data->product_name , ' ') }}" title="{{ str_slug_fa($data->product_name , ' ') }}" class="img-primary"
                 data-src="{{ url('files').'/'.$imgf[0] }}"
                 src="#"/>
            <img alt="{{ str_slug_fa($data->product_name , ' ') }}" title="{{ str_slug_fa($data->product_name , ' ') }}" class="img-secondary"
                 data-src="{{ url('files').'/'.$imgf[count($imgf)-1] }}" src="#"/>
        </a>
        <div class="prod-btns">
            <button class="product-btn p_show" data-href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}" type="button" data-toggle="tooltip"
                    title="@lang('custom.save_order')">
                <i class="fa fa-money"></i>
            </button>
            {{--<button data-rel="details" data-product="28" class="product-btn quickview">
                <i class="fa fa-search-plus"></i>
            </button>--}}
            <button class="product-btn p_favorite" data-productid="{{$data->id}}" type="button" data-toggle="tooltip"
                    title="@lang('custom.favorite')">
                <i class="fa fa-heart"></i>
            </button>
        </div>
        <div class="caption">
            <div class="name">
                <a href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}">{{ $data->product_name }}</a>
            </div>
            <div class="price">
                {{ $data->prices }}
                @lang('custom.prices_currency_val.'.$data->prices_currency )
                @lang('custom.at')
                @lang('custom.amount_val.'.$data->prices_unit )
            </div>
            <div class="cart-button">
                <button class="product-btn-add" type="button"><i
                            class="fa fa-shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
    {{--<div class="sale">
        <span>20%</span>
    </div>
    <div class="new-pr">
        <span>جدید</span>
    </div>--}}
</div>
@inject('productCatFront', 'App\Libraries\ProductCatFront')
<aside id="column-left" class="col-sm-3">
    <div class="megamenu">
        <h3><a href="#"><i class="fa fa-list"></i>@lang('custom.all_product_cat')</a></h3>
        <ul class="sf-menu">

        @foreach($productCatFront->fetch() as $key=>$val)
                @if(count($val->children) == 0)
                    <li>
                        <a href="{{ route('products.categories.list',['id'=>$val->id,'title'=>str_slug_fa($val->title)]) }}" data-hover="{{ str_slug_fa($val->title) }}"><span> {{ $val->title }} </span></a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('products.categories.list',['id'=>$val->id,'title'=>str_slug_fa($val->title)]) }}" data-hover="{{ str_slug_fa($val->title) }}"><span>{{ $val->title }}</span></a>
                        <ul class="simple_menu">
                            @foreach($val->children as $key2=>$val2)
                                @if(count($val2->children) == 0)
                                    <li>
                                        <a href="{{ route('products.categories.list',['id'=>$val2->id,'title'=>str_slug_fa($val2->title)]) }}">{{ $val2->title }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('products.categories.list',['id'=>$val2->id,'title'=>str_slug_fa($val2->title)]) }}" class="parent">{{ $val2->title }}</a>
                                        <ul class="simple_menu">
                                            @foreach($val2->children as $key3=>$val3)
                                            <li>
                                                <a href="{{ route('products.categories.list',['id'=>$val3->id,'title'=>str_slug_fa($val3->title)]) }}">{{ $val3->title }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach


        </ul>
    </div>
    <script>
        (function ($) {
            $(window).load(function () {
                var o = $('.sf-menu');
                o.superfish();
                o.find('li a').each(function () {
                    if ($(location).attr('href').indexOf($(this).attr('href')) >= 0) {
                        $(this).addClass('active');
                        return;
                    }
                })
                if (o.parents('aside').length) {
                    var width = $('.container').outerWidth() - $('aside').outerWidth();
                    o.find('.sf-mega').each(function () {
                        $(this).width(width);
                    })
                }
            });
        })(jQuery);
    </script>
</aside>
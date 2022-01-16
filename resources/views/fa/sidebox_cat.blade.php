@inject('productCatFront', 'App\Libraries\ProductCatFront')
@php
    $fr = $productCatFront->fetch_rand();
@endphp


<div class="box bestsellers">
    <div class="box-heading">
        <h3>{{ $fr['cat']->title }}</h3>
    </div>
    <div class="box-content">
        <div class="bot-carousel">
            @foreach($fr['pcat'] as $val)
                @include(App::getLocale().'.small_box_product' , ['data'=>$val])
            @endforeach
        </div>
    </div>
</div>
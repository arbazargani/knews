@php
    $imgf = json_decode($data->file_url , true);
@endphp

<a class="clearfix" href="{{ route('products.show',['id'=> $data->id,'title'=> str_slug_fa($data->product_name)  ]) }}">
    <img src="{{ url('files').'/'.$imgf[0] }}" alt="{{ str_slug_fa($data->product_name , ' ') }}" title="{{ str_slug_fa($data->product_name , ' ') }}"
         class="img-responsive"/>
    <div class="s-desc"><h5>{{ $data->product_name }}</h5>
        {{--<div class="new-pr"><span>New</span></div>--}}
    </div>
</a>
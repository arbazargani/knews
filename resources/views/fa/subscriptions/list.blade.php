@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.subscriptions') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-md-12 col-sm-12 col-xs-12 custyle table-responsive">
                    <h1>@lang('custom.tariff_services')</h1>

                    <table class="table table-hover table-striped custab tariff">
                        <thead>
                        <tr>
                            <th>@lang('custom.descr_services')</th>
                            @foreach( $sub_scriptions as $key=>$val )
                                <th>{{ $val->title }}</th>
                            @endforeach
                        </tr>
                        </thead>

                        <tr>
                            <td>@lang('custom.count_products')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>{{ $val->count_product }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.intro_to_lang',['count'=>count(config('app.locales')) , 'lang'=> implode(' , ', array_flatten(config('app.locales'))) ])</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                @php
                                    $a = explode(',',$val->lang);
                                    $b = '';
                                    foreach ($a as $vals){
                                        $b .= config('app.locales.'.$vals) .' , ';
                                    }
                                @endphp
                                <td>{{ trim($b , ' , ') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.subdomain_service',['count'=>count(config('app.locales'))])</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    @lang('custom.'.$val->special_page)
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.slider_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    @lang('custom.'.$val->special_page_slider)
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.advertising_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    @lang('custom.'.$val->advertising)
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.message_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    @lang('custom.'.$val->message)
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.duration_membership_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    {{ $val->duration_membership }} @lang('custom.month')
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.base_price_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    {{ $val->base_price }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>@lang('custom.price_product_addition_service')</td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    {{ $val->price_product_addition }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td></td>
                            @foreach( $sub_scriptions as $key=>$val )
                                <td>
                                    <a href="{{ route('sub_scriptions.order',['id'=>$val->id]) }}"
                                       class="btn">@lang('custom.order_service')</a>
                                </td>
                            @endforeach
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
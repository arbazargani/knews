@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.products_list') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-sm-12"> <h1>@lang('custom.products_list')</h1>

                    <div dir="@lang('custom.lang.'.App::getLocale().'.dir')">
                        <div id="grid1"></div>
                    </div>

                    @push('style')
                    <link rel="stylesheet" type="text/css"
                          href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/default/easyui.css') }}">
                    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/icon.css') }}">
                    <link rel="stylesheet" type="text/css"
                          href="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.css')  }}">
                    <style>
                        span.l-btn-icon{
                            font-size: 14px;
                        }
                    </style>
                    @endpush

                    @push('script_bottom')
                    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/jquery.easyui.min.js')  }}"></script>
                    <script type="text/javascript"
                            src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.js')  }}"></script>

                    <script type="text/javascript"
                            src="{{ asset('assets/plugins/jquery-easyui-1.4.4/locale/easyui-lang-fa.js')  }}"></script>
                    <script type="text/javascript" src="{{ asset('js/jalaali.js')  }}"></script>
                    <script>
                        $(function () {
                            var dg = $('#grid1').datagrid({
                                remoteFilter: true,
                                multiSort: true,
                                iconCls: 'fa fa-dashboard',
                                filterBtnIconCls: 'icon-filter',
                                rowNumbers: true,
                                singleSelect: true,
                                pagination: true,
                                height: 450,
                                width: '100%',
                                title: '@lang('custom.my_products')',
                                sortOrder: 'asc',
                                url: '{{ route('profile.products.list.post') }}',
                                columns: [
                                    [
                                        {field: 'title', title: '@lang('custom.product_name')', width: '30%', halign: 'center', sortable: true},
                                        {field: 'prices', title: '@lang('custom.prices')', width: '25%', halign: 'center', sortable: true},
                                        {field: 'status', title: '@lang('custom.status')', width: '10%', halign: 'center', sortable: true,
                                            formatter: function (val,row) {
                                                console.log(row);
                                                if(val == 'active')
                                                    return 'فعال';
                                                if(val == 'deactive')
                                                    return 'غیر فعال';
                                            }
                                        },
                                        {
                                            field: 'id', title: '@lang('custom.edit')', width: '25%', align: 'center', formatter: function (val) {
                                            return '<a href="{{ route('profile.index') }}/products/' + val + '/edit"> @lang('custom.edit') @lang('custom.product') </a>';
                                        }
                                        },
                                    ]
                                ]
                            });

                        });
                    </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>
@endsection
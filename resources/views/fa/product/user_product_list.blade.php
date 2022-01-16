@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.your_order') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-sm-12"> <h1>@lang('custom.your_order')</h1>

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
                        .datagrid-row:nth-child(even){
                            background:#ccc;
                        }
                    </style>
                    @endpush

                    @push('script_bottom')
                    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/jquery.easyui.min.js')  }}"></script>
                    <script type="text/javascript"
                            src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.js')  }}"></script>
                    <script type="text/javascript"
                            src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/datagrid-filter/datagrid-filter.js')  }}"></script>
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
                                title: '@lang('custom.your_order')',
                                sortOrder: 'asc',
                                url: '{{ route('products.order.list.post') }}',
                                columns: [
                                    [
                                        {field: 'product_name', title: '@lang('custom.product_name')', width: '30%', halign: 'center', sortable: true},
                                        /*{field: 'name', title: '@lang('auth.name')', width: '10%', halign: 'center', sortable: true},
                                        {field: 'family', title: '@lang('auth.family')', width: '10%', halign: 'center', sortable: true},*/
                                        {field: 'user_status', title: '@lang('custom.status')', width: '15%', halign: 'center', sortable: true,
                                            formatter: function (val,row) {
                                                if(val == 'favorite')
                                                    return '@lang('custom.user_status.favorite')';
                                                if(val == 'pre_order')
                                                    return '@lang('custom.user_status.pre_order')';
                                                if(val == 'order')
                                                    return '@lang('custom.user_status.order')';
                                            }
                                        },
                                        {
                                            field: 'created_at',
                                            title: '@lang('custom.send_date')',
                                            width: '20%',
                                            align: 'center',
                                            sortable: true,
                                            styler: ltrStyler,
                                            formatter: function (val) {
                                                return convertToJalali(val, 'datetime');
                                            }
                                        },
                                        {
                                            field: 'id', title: '@lang('custom.delete')', width: '20%', align: 'center',
                                            formatter: function (val,row) {

                                                if(row.user_status == 'favorite')
                                                    return '<a href="{{ route('products.order.delete',['id'=>'']) }}/' + val + '"> @lang('custom.delete')</a>';
                                                else
                                                    return '';

                                            }
                                        },
                                    ]
                                ]
                            });

                            function ltrStyler(value, row, index) {
                                return 'direction:ltr;';
                            }

                            /*dg.datagrid('enableFilter', [
                             {
                             field: 'status',
                             type: 'combobox',
                             options: {
                             panelHeight: 'auto',
                             data: [{value: '', text: 'همه'}, {value: 'active', text: 'فعال'}, {
                             value: 'deactive',
                             text: 'غیر فعال'
                             }],
                             onChange: function (value) {
                             if (value == '') {
                             dg.datagrid('removeFilterRule', 'status');
                             } else {
                             dg.datagrid('addFilterRule', {
                             field: 'status',
                             op: 'equal',
                             value: value
                             });
                             }
                             dg.datagrid('doFilter');
                             }
                             }
                             },
                             {
                             field: 'created_at',
                             type: 'validatebox',
                             options: {precision: 1},
                             op: ['less', 'greater']
                             }
                             ]);*/
                            $('input[name=created_at]')
                                .css('direction', 'ltr')
                                .addClass('input-group-addon')
                                .attr('data-MdDateTimePicker', 'true')
                                .attr('data-enabletimepicker', 'true')
                                .attr('readonly', 'true')
                            ;
                        });
                    </script>
                    <script type="text/javascript" src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/calendar.js') }}"></script>
                    <link rel="stylesheet" type="text/css"
                          href="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css')  }}">
                    <script type="text/javascript"
                            src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>
                    @endpush

                </div>
            </div>
        </div>
    </div>
@endsection
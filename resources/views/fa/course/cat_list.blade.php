@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.all_cat') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-sm-12"> <h1>@lang('custom.all_cat')</h1>

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
                            background: #f5f5f5;
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
                                title: '@lang('custom.all_cat')',
                                sortOrder: 'asc',
                                url: '{{ route('course.cat.list.post') }}',
                                columns: [
                                    [
                                        {field: 'ctitle', title: '@lang('custom.title')', width: '45%', halign: 'center', sortable: true},
                                        /*{
                                            field: 'updated_at',
                                            title: '@lang('custom.send_date')',
                                            width: '20%',
                                            align: 'center',
                                            sortable: true,
                                            styler: ltrStyler,
                                            formatter: function (val) {
                                                return convertToJalali(val, 'datetime');
                                            }
                                        },*/
                                        {
                                            field: 'id', title: '@lang('custom.view')', width: '20%', align: 'center',
                                            formatter: function (val,row) {
                                                return '<a href="{{ route('course.index',['']) }}/' + val + '">@lang('custom.content_list')</a>';
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
@extends('_layouts.admin')
@section('menu_active', 'contactus')

@section('title', 'تماس با ما')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i
                    class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>تماس با ما</span>
        </li>
    </ul>

@endsection


@section('content')
    <h3 class="page-title"> لیست تماس با ما:
        <small>لیست موارد ارسالی تماس با ما</small>
    </h3>

    <div dir="rtl">
        <div id="grid1"></div>
    </div>


    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('custom.contactus')</h4>
                </div>
                <div class="modal-body">

                    {{--<div class="row">--}}
                        {{--<div class="col-md-2">--}}
                            {{--<label>نام : </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<span id="name"></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-2">--}}
                            {{--<label>عنوان : </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<span id="title"></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-2">--}}
                            {{--<label>تلفن : </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-10">--}}
                            {{--<span id="tel"></span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row">
                        <div class="col-md-2">
                            <label>ایمیل : </label>
                        </div>
                        <div class="col-md-10">
                            <span id="email"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>متن : </label>
                        </div>
                        <div class="col-md-10">
                            <span id="text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('style')
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/default/easyui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/icon.css') }}">
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.css')  }}">
@endpush

@push('script')
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
            title: 'لیست موارد ارسالی تماس با ما',
            sortOrder: 'asc',
            url: '{{ route('admin.contactus.list') }}',
            columns: [
                [
                    // {field: 'name', title: 'نام', width: '20%', halign: 'center', sortable: true},
                    {field: 'email', title: 'ایمیل', width: '30%', halign: 'center', sortable: true},
                    // {field: 'phone', title: 'تلفن', width: '10%', halign: 'center', sortable: true},
                    {
                        field: 'status',
                        title: 'وضعیت',
                        width: '10%',
                        halign: 'center',
                        sortable: true,
                        formatter: function (val) {
                            if (val == 'unread')
                                return 'خوانده نشده';
                            if (val == 'read')
                                return 'خوانده شده';
                        }
                    },
                    {
                        field: 'created_at',
                        title: 'تاریخ ارسال',
                        width: '15%',
                        align: 'center',
                        sortable: true,
                        styler: ltrStyler,
                        formatter: function (val) {
                            return convertToJalali(val, 'datetime');
                        }
                    }
                ]
            ],
            toolbar: [
                {
                    id: 'btnCatEdit',
                    text: 'مشاهده',
                    iconCls: 'fa fa-edit',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            var url = '{{ route('admin.get.contactus') }}';

                            var params = {
                                _method: 'PUT',
                                post_id: row.id
                            };
                            $.post(url, params, function (data) {
                                if (data.ok) {
                                    // $('#name').text(data.data.name);
                                    $('#email').text(data.data.email);
                                    // $('#title').text(data.data.title);
                                    // $('#tel').text(data.data.phone);
                                    $('#text').html(data.data.fulltext);
                                    $('.bs-example-modal-lg').modal('toggle');
                                    dg.datagrid('reload');
                                }
                                else
                                    $.messager.alert('توجه', data.message, 'error');
                            }, 'json').fail(function () {
                                $.messager.alert('توجه', 'خطا در برقراری ارتباط با سرور', 'error');
                            });


                            //window.location.href = '{{ url('admin/cat')  }}/' + row.id + '/edit/';

                        }
                        else {
                            $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                        }
                    }
                },
                {
                    id: 'btnCatRemove',
                    text: 'حذف',
                    iconCls: 'fa fa-remove',
                    disabled: true,
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        $.messager.confirm('توجه', 'آیا از حذف مطمئن هستید؟', function (r) {
                            if (r) {
                                var params = {
                                    _method: 'DELETE',
                                    post_id: row.id
                                };
                                $.post('{{ route('admin.contactus.delete') }}', params, function (data) {
                                    if (data.ok)
                                        dg.datagrid('reload');
                                    else
                                        $.messager.alert('توجه', data.message, 'error');
                                }, 'json').fail(function () {
                                    $.messager.alert('توجه', 'خطا در برقراری ارتباط با سرور', 'error');
                                });
                            }
                        });
                    }
                }
            ],
            onSelect: function (index, row) {
                $('#btnCatRemove').linkbutton('enable');
                $('#btnCatActive').linkbutton('enable');
                $('#btnCatEdit').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnCatRemove').linkbutton('disable');
                $('#btnCatActive').linkbutton('disable');
                $('#btnCatEdit').linkbutton('disable');
            }
        });

        function ltrStyler(value, row, index) {
            return 'direction:ltr;';
        }

        dg.datagrid('enableFilter', [
            {
                field: 'status',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: [{value: '', text: 'همه'}, {value: 'unread', text: 'خوانده نشده'}, {
                        value: 'read',
                        text: 'خوانده شده'
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
            }, {
                field: 'department',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: [
                        {value: '', text: 'همه'},
                        {value: 'support', text: '@lang('custom.support')'},
                        {value: 'feedback', text: '@lang('custom.feedback')'},
                        {value: 'technical', text: '@lang('custom.technical')'}
                    ],
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'department');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'department',
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
        ]);
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
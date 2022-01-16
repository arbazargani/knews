@extends('_layouts.admin')
@section('menu_active', 'products')

@section('title', 'مدیریت محصولات')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>لیست محصولات</span>
        </li>
    </ul>

@endsection

@section('content')
    <h3 class="page-title"> لیست محصولات:
        <small>تمام محصولات</small>
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
                    <h4 class="modal-title" id="myModalLabel">@lang('custom.order_service')</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label>اطلاعات شرکت</label>

                            <div class="row">
                                <div class="col-md-4">
                                    <label>نام شرکت: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="company_name"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>برند: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="company_brand"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>تلفن تماس: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="company_tel"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>فاکس: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="company_fax"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label>اطلاعات درخواست کننده</label>

                            <div class="row">
                                <div class="col-md-4">
                                    <label>نام : </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="user_name"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>نام خانوادگی: </label>
                                </div>
                                <div class="col-md-7">
                                    <span id="user_family"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>تلفن تماس: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="user_tel"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>ایمیل: </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="user_email"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>وضعیت: </label>
                        </div>
                        <div class="col-md-9">
                            <select name="status" id="status">
                                <option value="wait">منتظر</option>
                                <option value="call">تماس</option>
                                <option value="pre_order">پیش سفارش</option>
                                <option value="order"> سفارش</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>توضیحات: </label>
                        </div>
                        <div class="col-md-7">
                            <input type="hidden" name="up_id" id="up_id" value="0"  />
                            <textarea style="width: 100%; height: 150px;" name="descr" id="descr"></textarea>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnSaveStatusAdmin">ذخیره</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
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

        $('.btnSaveStatusAdmin').click(function () {
            url_save = '{{ route('admin.products.list.order.status.put') }}';
            var params = {
                _method: 'PUT',
                id: $('#up_id').val(),
                status: $('#status').val(),
                descr: $('#descr').val()
            };
            $.post(url_save, params, function (data) {
                if (data.ok) {

                    $('.bs-example-modal-lg').modal('toggle');
                    dg.datagrid('reload');
                }
                else
                    $.messager.alert('توجه', data.message, 'error');
            }, 'json').fail(function () {
                $.messager.alert('توجه', 'خطا در برقراری ارتباط با سرور', 'error');
            });

        });

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
            title: 'لیست محصولات',
            sortOrder: 'asc',
            url: '{{ route('admin.products.list.order.post') }}',
            columns: [
                [
                    {field: 'product_name', title: 'نام محصول', width: '20%', halign: 'center', sortable: true},
                    {field: 'name', title: 'نام', width: '15%', halign: 'center', sortable: true},
                    {field: 'family', title: 'نام خانوادگی', width: '10%', halign: 'center', sortable: true},
                    {
                        field: 'admin_status',
                        title: 'وضعیت',
                        width: '10%',
                        halign: 'center',
                        sortable: true,
                        formatter: function (val) {
                            if (val == 'wait')
                                return 'منتظر';
                            if (val == 'call')
                                return 'تماس';
                            if (val == 'pre_order')
                                return 'پیش سفارش';
                            if (val == 'order')
                                return 'سفارش';
                        }
                    },
                    {
                        field: 'created_at',
                        title: 'تاریخ ثبت',
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
                            var url = '{{ route('admin.products.list.order.put') }}';

                            var params = {
                                _method: 'PUT',
                                post_id: row.id
                            };
                            $.post(url, params, function (data) {
                                if (data.ok) {
                                    $('#company_name').text(data.user_company.company_name);
                                    $('#company_tel').text(data.user_company.tel);
                                    $('#company_fax').text(data.user_company.fax);
                                    $('#company_brand').text(data.user_company.brand);

                                     $('#user_name').text(data.user.name);
                                    $('#user_family').text(data.user.family);
                                    $('#user_tel').text(data.user.mobile);
                                    $('#user_email').text(data.user.email);

                                    $('#status').val(data.user_product.admin_status);
                                    $('#descr').val(data.user_product.admin_descr);
                                    $('#up_id').val(data.user_product.id);

                                    $('.bs-example-modal-lg').modal('toggle');
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
                }
            ]
        });

        function ltrStyler(value, row, index) {
            return 'direction:ltr;';
        }

        dg.datagrid('enableFilter', [
            {
                field: 'admin_status',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: [
                        {value: '', text: 'همه'},
                        {value: 'wait', text: 'منتظر'},
                        {value: 'call', text: 'تماس'},
                        {value: 'pre_order', text: 'پیش سفارش'},
                        {value: 'order', text: 'سفارش'}
                    ],
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'admin_status');
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
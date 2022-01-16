@extends('_layouts.admin')
@section('menu_active', 'products')
@section('title', 'مدیریت مطالب ارسالی')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.products.index') }}">پیشخوان</a> <i
                    class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>لیست مطالب ارسالی</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.products.create') }}"> <i class="icon-user"></i> ثبت مطلب جدید</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.products.index') }}"> <i class="icon-bell"></i> لیست مطالب ارسالی</a>
                </li>

            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> لیست مطالب ارسالی:
        <small>
            مطالب ارسالی        </small>
    </h3>

    <div dir="rtl">
        <div id="grid1"></div>
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
<script type="text/javascript" src="{{ asset('assets/js/jalaali.js')  }}"></script>
<script>
    $(function () {
        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fa fa-dashboard',
            //filterBtnIconCls: 'fa fa-filter',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: true,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'لیست مطالب ارسالی',
            sortOrder: 'asc',
            url: '{{ route('admin.products.items') }}',
            columns: [
                [
                    {field: 'title', title: 'عنوان', width: '50%', halign: 'center', sortable: true},
                    {field: 'show_order', title: 'اولویت نمایش', width: '20%', halign: 'center', sortable: true},
                    {field: 'visit', title: 'تعداد مشاهده شده', width: '10%', halign: 'center', sortable: true},
                    {field: 'price', title: 'قیمت', width: '10%', halign: 'center', sortable: true}
                ]
            ],
            toolbar: [
                {
                    text: 'ویرایش',
                    iconCls: 'fa fa-edit',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            window.location.href = '{{ route('admin.products.edit','') }}/' + row.id;
                        }
                        else {
                            $.messager.alert('توجه', 'لطفا یک ردیف انتخاب کنید', 'warning');
                        }
                    }
                },
                {
                    text: 'حذف',
                    iconCls: 'fa fa-trash-o',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            $.messager.confirm('توجه', ' آیا از حذف این مطلب مطمئن  هستید؟ ', function (r) {
                                if (r) {
                                    var params = {
                                        _token: '{{ csrf_token() }}',
                                        _method: 'DELETE',
                                        id: row.id
                                    };
                                    $.post('{{ route('admin.products.delete') }}', params, function (data) {
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
                        else {
                            $.messager.alert('توجه', 'لطفا یک ردیف انتخاب کنید', 'warning');
                        }
                    }
                }
            ]
        });

        function ltrStyler(value, row, index) {
            return 'direction:ltr;';
        }

        dg.datagrid('enableFilter');


    });
</script>

<script type="text/javascript" src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/calendar.js') }}"></script>
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css')  }}">
<script type="text/javascript"
        src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>

@endpush
@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', 'مدیریت اعضا')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
            <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>لیست اعضا</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع
                <i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.users.create') }}"> <i class="fa fa-check"></i> ثبت کاربر جدید</a>
                </li>
                <li class="divider"></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> لیست کاربران سایت:
        <small>مدیریت کاربران</small>
    </h3>

    <div dir="rtl">
        <div id="grid1"></div>
    </div>

    @push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/default/easyui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.css')  }}">
    @endpush

    @push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/jquery.easyui.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/datagrid-filter/datagrid-filter.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/locale/easyui-lang-fa.js')  }}"></script>
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
                title: 'لیست اعضا',
                sortOrder: 'asc',
                url: '{{ route('admin.users.index_items') }}',
                columns: [
                    [
                        {
                            field: 'family', title: 'نام خانوادگی - نام', width: '20%', halign: 'center', sortable: true,
                            formatter: function (val, row) {
                                return val + ' - ' + row.name ;
                            }
                        },
                        {
                            field: 'username',
                            title: 'نام کاربری',
                            width: '20%',
                            align: 'left',
                            halign: 'center',
                            sortable: true,
                            formatter: function (val) {
                                return '<span lang="en">' + val + '</span>';
                            }
                        },
                        {
                            field: 'email',
                            title: 'رایانامه',
                            width: '25%',
                            align: 'left',
                            halign: 'center',
                            sortable: true,
                            formatter: function (val) {
                                return '<span lang="en">' + val + '</span>';
                            }
                        },
                        {
                            field: 'created_at', title: 'تاریخ ثبت نام', width: '10%', align: 'center', sortable: true,
                            formatter: function (val) {
                                return convertToJalali(val);
                            }
                        },
                        {
                            field: 'updated_at',
                            title: 'تاریخ آخرین ویرایش',
                            width: '10%',
                            align: 'center',
                            sortable: true,
                            formatter: function (val) {
                                return convertToJalali(val);
                            }
                        }
                    ]
                ],
                toolbar: [
                    {
                        text: 'نمایش اطلاعات',
                        iconCls: 'fa fa-file-text-o',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                window.location.href = '{{ route('admin.users.index') }}/' + row.id;
                            }
                            else {
                                $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                            }
                        }
                    },
                    {
                        text: 'ویرایش اطلاعات',
                        iconCls: 'fa fa-edit',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                window.location.href = '{{ route('admin.users.index') }}/' + row.id + '/edit';
                            }
                            else {
                                $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                            }
                        }
                    }
                    , {
                        text: 'فعال / غیر فعال',
                        iconCls: 'fa fa-check',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                $.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید نقش را تغییر دهید؟', function (r) {
                                    if (r) {
                                        var params = {
                                            _token: '{{ csrf_token() }}',
                                            _method: 'DELETE'
                                        };
                                        $.post('{{ route('admin.users.index') }}/' + row.id + '/active', params, function (data) {
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
                    , {
                        text: 'حذف کاربر',
                        iconCls: 'fa fa-trash-o',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                $.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید کاربر را حذف نمایید؟', function (r) {
                                    if (r) {
                                        var params = {
                                            _token: '{{ csrf_token() }}',
                                            _method: 'DELETE'
                                        };
                                        $.post('{{ route('admin.users.index') }}/' + row.id, params, function (data) {
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
            /*
             dg.datagrid('enableFilter', [
             {
             field: 'created_at',
             type: 'numberbox',
             options: {precision: 1},
             op: ['equal', 'notequal', 'less', 'greater']
             }
             ]);
             */
        });
    </script>
    @endpush
@endsection
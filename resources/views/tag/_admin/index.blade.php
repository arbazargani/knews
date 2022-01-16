@extends('_layouts.admin')
@section('menu_active', 'tag')

@section('title', 'مدیریت تگ ها')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>لیست تگ ها</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.tag.create') }}"> <i class="icon-user"></i> ثبت تگ  جدید</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.tag.index') }}"> <i class="icon-shield"></i> لیست تگ ها من</a>
				</li>

			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> لیست جامع تگ ها:
		<small>تمام تگ ها</small>
	</h3>

	<div dir="rtl">
		<div id="grid1"></div>
	</div>
@endsection

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
            title: 'لیست تگ ها',
            sortOrder: 'asc',
            url: '{{ route('admin.tag.list') }}',
            columns: [
                [
                    {field: 'title', title: 'عنوان', width: '40%', halign: 'center', sortable: true},
                    {field: 'order', title: 'اولویت', width: '10%', halign: 'center', sortable: true},
                    // {
                    //     field: 'publish_at', title: 'تاریخ شروع نمایش', width: '15%', align: 'center', sortable: true, styler: ltrStyler,formatter: function (val) {
                    //     return convertToJalali(val ,'datetime');
                    // }
                    // },
                    // {
                    //     field: 'expired_at', title: 'تاریخ اتمام نمایش', width: '15%', align: 'center', sortable: true, styler: ltrStyler,formatter: function (val) {
                    //     return convertToJalali(val ,'datetime');
                    // }
                    // },
                    {
                        field: 'created_at', title: 'تاریخ ثبت', width: '15%', align: 'center', sortable: true, styler: ltrStyler,formatter: function (val) {
                        return convertToJalali(val ,'datetime');
                    }
                    }
                ]
            ],
            toolbar: [

                {
                    text: 'ویرایش',
                    iconCls: 'fa fa-edit',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            window.location.href = '{{ route('admin.tag.index') }}/' + row.id + '/edit';
                        }
                        else {
                            $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                        }
                    }
                }, '-',

                {
                    text: 'حذف',
                    iconCls: 'fa fa-remove',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            $.messager.confirm('توجه', 'آیا از حرف تگ  مطمئن هستید؟', function(r){
                                if(r)
                                {
                                    var params = {
                                        _method: 'DELETE',
                                        post_id : row.id
                                    };

                                    $.post('{{ route('admin.tag.delete') }}', params, function(data){
                                        if( data.ok )
                                            dg.datagrid('reload');
                                        else
                                            $.messager.alert('توجه', data.message, 'error');
                                    }, 'json').fail(function(){
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

        dg.datagrid('enableFilter', [
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
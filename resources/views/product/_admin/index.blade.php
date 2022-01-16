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
			title: 'لیست محصولات',
			sortOrder: 'asc',
			url: '{{ route('admin.products.list.post') }}',
			columns: [
				[
					{field: 'product_name', title: 'نام محصول', width: '30%', halign: 'center', sortable: true},
					{field: 'title', title: 'دسته بندی', width: '15%', halign: 'center', sortable: true},
					{field: 'company_name', title: 'نام شرکت', width: '10%', halign: 'center', sortable: true},
					{field: 'brand', title: 'برند', width: '10%', halign: 'center', sortable: true},
                    {field: 'status', title: 'وضعیت', width: '10%', halign: 'center', sortable: true, formatter: function (val) {
                            if(val == 'active')
                                return 'فعال';
                            if(val == 'deactive')
                                return 'غیر فعال';
                        }
                    },
                    {field: 'special', title: 'ویژه', width: '10%', halign: 'center', sortable: true, formatter: function (val) {
                        if(val == 'yes')
                            return 'بله';
                        if(val == 'no')
                            return 'خیر';
                    }
                    },
                    {
                        field: 'created_at', title: 'تاریخ ثبت', width: '15%', align: 'center', sortable: true, styler: ltrStyler,formatter: function (val) {
                        return convertToJalali(val ,'datetime');
                    }
                    }
                ]
			],
			toolbar: [
				/*{
					text: 'مشاهده',
					iconCls: 'fa fa-file-text-o',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							window.location.href = '{{ route('admin.products.list') }}/' + row.id;
						}
						else {
							$.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
						}
					}
				}, '-',*/
				{
					text: 'ویرایش',
					iconCls: 'fa fa-edit',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							window.location.href = '{{ route('profile.products.index') }}/' + row.id + '/edit';
						}
						else {
							$.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
						}
					}
				}, '-',
				{
					text: 'فعال / غیر فعال',
					iconCls: 'fa fa-check',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							$.messager.confirm('توجه', 'آیا از تغییر وضعیت مطمئن هستید؟', function(r){
								if(r)
								{
									var params = {
										_method: 'DELETE',
										post_id : row.id
									};
									$.post('{{ route('admin.products.deactive') }}', params, function(data){
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
				}, '-',
                {
                    text: 'ویژه / غیر ویژه',
                    iconCls: 'fa fa-check',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            $.messager.confirm('توجه', 'آیا از تغییر وضعیت مطمئن هستید؟', function(r){
                                if(r)
                                {
                                    var params = {
                                        _method: 'PUT',
                                        post_id : row.id
                                    };
                                    $.post('{{ route('admin.products.special.put') }}', params, function(data){
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
                }, '-',
				{
					text: 'حذف',
					iconCls: 'fa fa-remove',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							$.messager.confirm('توجه', 'آیا از حذف مطمئن هستید؟', function(r){
								if(r)
								{
									var params = {
										_method: 'DELETE',
										post_id : row.id
									};

									$.post('{{ route('admin.products.delete') }}', params, function(data){
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
				field: 'special',
				type: 'combobox',
				options: {
					panelHeight: 'auto',
					data: [{value: '', text: 'همه'}, {value: 'yes', text: 'بله'}, {
						value: 'no',
						text: 'خیر'
					}],
					onChange: function (value) {
						if (value == '') {
							dg.datagrid('removeFilterRule', 'special');
						} else {
							dg.datagrid('addFilterRule', {
								field: 'special',
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
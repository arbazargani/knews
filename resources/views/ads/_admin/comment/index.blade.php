@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', 'مدیریت نظرات اخبار')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.index') }}">لیست اخبار</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>لیست نظرات</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.news.index') }}"> <i class="icon-bell"></i> لیست اخبار من</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> لیست نظرات:
		<small>نظراتی که به اخبار داده شده است</small>
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
			title: 'لیست اخبار دریافتی',
			sortOrder: 'asc',
			url: '{{ route('admin.news.comment.items') }}',
			columns: [
				[
					{field: 'text', title: 'متن نظر', width: '45%', halign: 'center', sortable: true, formatter: function (val, row) {
						return '<a href="{{ route('admin.news.comment.index') }}/' + row.id + '">' + val + '</a>';
					}},
					{field: 'name', title: 'نویسنده نظر', width: '19%', align: 'center', sortable: true},
					{
						field: 'is_show', title: 'وضعیت', width: '9%', align: 'center', sortable: true, formatter: function (val) {
						if (val)
							return '<span class="text-success">فعال</span>';
						else
							return '<span class="text-danger">غیر فعال</span>';
					}
					},
					{
						field: 'created_at', title: 'تاریخ ثبت', width: '11%', align: 'center', sortable: true, formatter: function (val) {
						return convertToJalali(val);
					}},
					{
						field: 'updated_at', title: 'تاریخ آخرین ویرایش', width: '11%', align: 'center', sortable: true, formatter: function (val) {
						return convertToJalali(val);
					}
					}
				]
			],
			toolbar: [
				{
					text: 'مشاهده',
					iconCls: 'fa fa-file-text-o',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							window.location.href = '{{ route('admin.news.comment.index') }}/' + row.id;
						}
						else {
							$.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
						}
					}
				}, '-',
				{
					text: 'ویرایش',
					iconCls: 'fa fa-edit',
					handler: function () {
						var row = $('#grid1').datagrid('getSelected');
						if (row) {
							window.location.href = '{{ route('admin.news.comment.index') }}/' + row.id + '/edit';
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
							$.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید نظر را تغییر وضعیت دهید؟', function(r){
								if(r)
								{
									var params = {
										_method: 'PUT'
									};
									$.post('{{ route('admin.news.comment.index') }}/' + row.id + '/active', params, function(data){
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
							$.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید نظر را حذف نمایید؟', function(r){
								if(r)
								{
									var params = {
										_method: 'DELETE'
									};
									$.post('{{ route('admin.news.comment.index') }}/' + row.id, params, function(data){
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
		dg.datagrid('enableFilter', [
			{
				field: 'created_at',
				type: 'numberbox',
				options: {precision: 1},
				op: ['equal', 'notequal', 'less', 'greater']
			}
		]);
	});
</script>
@endpush
@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', 'مدیریت نقش ها')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.user.index') }}">لیست اعضا</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>لیست نقش ها</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i> </button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.user.role.create') }}"> <i class="fa fa-check"></i> ثبت نقش جدید</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.user.create') }}"> <i class="fa fa-check"></i> ثبت کاربر جدید</a>
				</li>
				<li>
					<a href="{{ route('admin.user.index') }}"> <i class="fa fa-check"></i> لیست کاربران</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> لیست نقش ها:
		<small>مدیریت نقش ها</small>
	</h3>

	<div dir="rtl">
		<div id="grid1"></div>
	</div>

    @style('plugins/jquery-easyui-1.4.4/themes/default/easyui.css')
    @style('plugins/jquery-easyui-1.4.4/themes/icon.css')
    @style('plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.css')

    @script('plugins/jquery-easyui-1.4.4/jquery.easyui.min.js')
    @script('plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.js')
    @script('plugins/jquery-easyui-1.4.4/extension/datagrid-filter/datagrid-filter.js')
    @script('plugins/jquery-easyui-1.4.4/locale/easyui-lang-fa.js')
    @script('js/jalaali.js')

    @push('script')
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
                title: 'لیست نقش ها',
                sortOrder:'asc',
                url: '{{ route('admin.user.role.index_items') }}',
                columns: [
                    [
                        {field: 'title', title: 'عنوان', width: '30%', halign: 'center', sortable: true, formatter:function(val, row){
                            return '<a href="{{ route('admin.user.role.index') }}/'+ row.id +'">'+ val +'</a>';
                        }},
                        {field: 'level', title: 'سطح', width: '15%', align: 'center', sortable: true},
                        {field: 'created_at', title: 'تاریخ ثبت نام', width: '15%', align: 'center', sortable: true, formatter: function(val){
                            return convertToJalali(val);
                        }},
                        {field: 'updated_at', title: 'تاریخ آخرین ویرایش', width: '15%', align: 'center', sortable: true, formatter: function(val){
                            return convertToJalali(val);
                        }},
                        {field: 'deleted_at', title: 'تاریخ غیر فعال شدن', width: '15%', align: 'center', sortable: true, formatter: function(val){
                            if(val == null)
                                return '<span class="text-success">فعال</span>';
                            else
                                return '<span class="text-danger">'+ convertToJalali(val) +'</span>';
                        }}
                    ]
                ],
                toolbar: [
                    {
                        text: 'نمایش',
                        iconCls: 'fa fa-file-text-o',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                window.location.href = '{{ route('admin.user.role.index') }}/' + row.id;
                            }
                            else {
                                $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                            }
                        }
                    },
                    {
                        text: 'ویرایش',
                        iconCls: 'fa fa-edit',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                window.location.href = '{{ route('admin.user.role.index') }}/' + row.id + '/edit';
                            }
                            else {
                                $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                            }
                        }
                    }
                    ,{
                        text: 'فعال / غیر فعال',
                        iconCls: 'fa fa-check',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                $.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید نقش را تغییر دهید؟', function(r){
                                    if(r)
                                    {
                                        var params = {
                                            _method: 'DELETE'
                                        };
                                        $.post('{{ route('admin.user.role.index') }}/' + row.id + '/active', params, function(data){
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
                    ,{
                        text: 'حذف',
                        iconCls: 'fa fa-trash-o',
                        handler: function () {
                            var row = $('#grid1').datagrid('getSelected');
                            if (row) {
                                $.messager.confirm('توجه', 'آیا مطمئن هستید که میخواهید نقش را حذف نمایید؟', function(r){
                                    if(r)
                                    {
                                        var params = {
                                            _method: 'DELETE'
                                        };
                                        $.post('{{ route('admin.user.role.index') }}/' + row.id, params, function(data){
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
            /*
            dg.datagrid('enableFilter',[
                {
                    field:'created_at',
                    type:'numberbox',
                    options:{precision:1},
                    op:['equal','notequal','less','greater']
                }
            ]);
            */
        });
    </script>
    @endpush
@endsection
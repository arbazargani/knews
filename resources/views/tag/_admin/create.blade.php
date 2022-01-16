@extends('_layouts.admin')
@section('menu_active', 'tag')

@section('title', 'ثبت تگ  جدید')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.tag.index') }}">لیست تگ ها</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>ثبت تگ  جدید</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.tag.index') }}"> <i class="fa fa-check"></i> لیست تگ ها</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> ثبت تگ  جدید:
		<small>از طریق فرم زیر اقدام به تعریف تگ  جدید نمایید.</small>
	</h3>

	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption font-green-haze">
				<i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ثبت تگ  جدید</span>
			</div>
			<div class="actions">
				<div class="btn-group">
					<button type="button" class="btn green btnFromSave">
						<i class="fa fa-save"></i> ذخیره
					</button>

					<button data-toggle="dropdown" class="btn green dropdown-toggle">
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right">
						<!--
						<li>
							<a href="javascript:;"> <i class="fa fa-print"></i> چاپ </a>
						</li>
						<li class="divider"></li>
						-->
						<li>
							<a href="javascript:;" class="btnFromReset"> <i class="fa fa-trash-o"></i> پاک کردن اطلاعات جاری</a>
						</li>
					</ul>
				</div>
				<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.tag.index') }}" title="بازگشت" > <i class="fa fa-arrow-left"></i> </a>
			</div>
		</div>
		<div class="portlet-body form">
			<form id="frm1" role="form" method="POST" autocomplete="off">
				<div class="form-body">
					<div class="row">
						<div class="col-md-9">

							<div class="form-group">
								<label class="control-label" for="input_title"><span class="text-danger">*</span> تیتر:</label>
								<div class="input-icon">
									<i class="fa fa-bell-o"></i> <input type="text" class="form-control" name="title" id="input_title">
								</div>
							</div>

						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="input_title"><span class="text-danger">*</span> اولویت:</label>
								<div class="input-icon">
									<i class="fa fa-bell-o"></i> <input type="text" class="form-control" name="order" id="input_order">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
					<button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
					<a href="{{ route('admin.tag.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
					@push('style')
					<link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
					@endpush
					@push('script')
					<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
					<script>
						$(document).ready(function(){
							$('.btnFromSave').click(function () {
								var $this = $(this).prop('disabled', true);
								var $form = $('#frm1');
								$form.find('.has-error').removeClass('has-error');
								$form.find('.help-block').remove();
								// CKEDITOR.instances['input_text'].updateElement();
								$.post('{{ route('admin.tag.store') }}', $form.serialize(), function (data) {
									if (data.ok) {
										window.location.replace('{{ route('admin.tag.index') }}');
									} else {
										$this.prop('disabled', false);
									}
								}, 'json').fail(function (jqXhr) {
									if (jqXhr.status === 401) //redirect if not authenticated user.
										window.location.replace('{{ route('login') }}');
									else if (jqXhr.status === 422) {
										$.each(jqXhr.responseJSON, function (key, value) {
											toastr.error(value);
										});
										$this.prop('disabled', false);
									} else
										$this.prop('disabled', false);
								});
							});

							$('.btnFromReset').click(function () {
								$('#frm1')[0].reset();
								CKEDITOR.instances['input_text'].setData('');
							});
						});
					</script>
					@endpush
				</div>
			</form>
		</div>
	</div>
@endsection
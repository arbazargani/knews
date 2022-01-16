@extends('_layouts.admin')
@section('menu_active', 'user')

@section('title', 'ویرایش کاربر')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.users.index') }}">لیست اعضا</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.users.show', $user->id) }}">جزئیات اطلاعات</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>ویرایش اطلاعات</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع <i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.users.show', $user->id) }}"> <i class="fa fa-check"></i> نمایش اطلاعات</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.users.index') }}"> <i class="fa fa-check"></i> لیست کاربران</a>
				</li>
				<li class="divider"></li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title">ویرایش اطلاعات کاربر:
		<small>از طریق فرم زیر اقدام به ویرایش کاربر نمایید.</small>
	</h3>

	<div class="row">
		<div class="col-md-12">

			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-green-haze">
						<i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ثبت کاربر جدید</span>
					</div>
					<div class="actions">
						<form autocomplete="off">
							<div class="btn-group">
								<button type="button" class="btn green btnFromSave">
									<i class="fa fa-save"></i> ذخیره
								</button>

								<button type="button" data-toggle="dropdown" class="btn green dropdown-toggle">
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
										<a href="javascript:;" class="btnFromReset"> <i class="fa fa-trash-o"></i> خالی کردن اطلاعات جاری</a>
									</li>
								</ul>
							</div>
							<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a>
							<a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.users.show', $user->id) }}" title="بازگشت"> <i class="fa fa-arrow-left"></i> </a>
						</form>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="frm1" role="form" method="POST" autocomplete="off">
						<input type="hidden" name="_method" value="PUT">
						<div class="form-body">
							<div class="row">
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_fname"><span class="text-danger">*</span> نام:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="text" class="form-control" name="fname" id="input_fname" value="{{$user->name}}">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_lname"><span class="text-danger">*</span> نام خانوادگی:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="text" class="form-control" name="lname" id="input_lname" value="{{$user->family}}">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_username"><span class="text-danger">*</span> نام کاربری:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="text" class="form-control" name="username" id="input_username" placeholder="a-z 0-9 . _ -" dir="ltr"  value="{{$user->username}}">
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_email"><span class="text-danger">*</span> پست الکترونیکی:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="text" class="form-control" name="email" id="input_email" placeholder="sample@email.com" dir="ltr"  value="{{$user->email}}">
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="alert alert-warning" role="alert">
											<strong>توجه!</strong> در صورتی که میخواهید رمز عبور عضو را تغییر دهید، قسمت زیر را پر کنید!
										</div>

										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_password"><span class="text-danger">*</span> رمز عبور:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="password" class="form-control" name="password" id="input_password" dir="ltr">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input_password_confirmation"><span class="text-danger">*</span> تکرار رمز عبور:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="password" class="form-control" name="password_confirmation" id="input_password_confirmation" dir="ltr">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="control-label" for="input_mobile"><span class="text-danger">*</span> موبایل:</label>
												<div class="input-icon">
													<i class="fa fa-bell-o"></i>
													<input type="text" class="form-control" value="{{ $user->mobile }}" name="mobile" id="input_mobile">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-actions">
							<button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
							<button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
							<a href="{{ route('admin.users.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>

							@push('script')
							<script>
								$(document).ready(function () {
									$('.btnFromSave').click(function () {
										var $this = $('.btnFromSave').prop('disabled', true);
										var $form = $('#frm1');
										$form.find('.has-error').removeClass('has-error');
										$form.find('.help-block').remove();
										$.post('{{ route('admin.users.update', $user->id) }}', $form.serialize(), function (data) {
											if (data.ok) {
												window.location.replace('{{ route('admin.users.index') }}');
											} else {
												$this.prop('disabled', false);
											}
										}, 'json').fail(function (jqXhr) {
											if (jqXhr.status === 401) //redirect if not authenticated users.
												window.location.replace('{{ route('login') }}');
											else if (jqXhr.status === 422) {
												$.each(jqXhr.responseJSON, function (key, value) {
													$('#input_' + key).after('<span class="help-block"> <strong>' + value[0] + '</strong> </span>').closest('.form-group').addClass('has-error');
												});
												$this.prop('disabled', false);
											} else
												$this.prop('disabled', false);
										});
									});

									$('.btnFromReset').click(function () {
										var $form = $('#frm1');
										$form[0].reset();
										$form.find('.has-error').removeClass('has-error');
										$form.find('.help-block').remove();
										$('#input_roles').trigger('change');
									});
								});
							</script>
							@endpush
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
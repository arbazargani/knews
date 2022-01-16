@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', 'ویرایش نظر')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.index') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.index') }}">لیست اخبار</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.comment.index') }}">لیست نظرات</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.news.comment.show', $comment->id) }}">مشاهده نظر</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>ویرایش نظر</span>
		</li>
	</ul>

	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.news.comment.index') }}"> <i class="icon-user"></i> لیست نظرات</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="{{ route('admin.news.index') }}"> <i class="icon-bell"></i> لیست اخبار</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> ویرایش نظر
		<small>جزئیات</small>
	</h3>

	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption font-green-haze">
				<i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ثبت خبر جدید</span>
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
				<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.news.index') }}" title="بازگشت" > <i class="fa fa-arrow-left"></i> </a>
			</div>
		</div>
		<div class="portlet-body form">
			<form id="frm1" role="form" method="POST">
				<input type="hidden" name="_method" value="PUT">
				<div class="form-body">
					<div class="row">
						<div class="col-sm-4">

							<div class="form-group">
								<label class="control-label" for="input_name"><span class="text-danger">*</span> نام:</label>
								<div class="input-icon">
									<i class="fa fa-bell-o"></i> <input type="text" class="form-control" name="name" id="input_name" value="{{ $comment->name }}">
								</div>
							</div>

							<div class="radio">
								<label>
									<input type="radio" name="status" value="1" @if($comment->is_show) checked @endif>
									<span>فعال</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="status" value="0" @if(!$comment->is_show) checked @endif>
									<span>غیر فعال</span>
								</label>
							</div>

						</div>

						<div class="col-sm-8">
							<div class="form-group">
								<label class="control-label" for="input_text"><span class="text-danger">*</span> متن:</label>
								<div class="input-icon">
									<i class="fa fa-bell-o"></i> <textarea class="form-control" name="text" id="input_text" rows="4">{{ br2null($comment->text) }}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
					<button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
					<a href="{{ route('admin.news.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>

					@push('script')
					<script>
						$(document).ready(function(){
							$('.btnFromSave').click(function () {
								var $this = $(this).prop('disabled', true);
								var $form = $('#frm1');
								$form.find('.has-error').removeClass('has-error');
								$form.find('.help-block').remove();
								$.post('{{ route('admin.news.comment.update', $comment->id) }}', $form.serialize(), function (data) {
									if (data.ok) {
										window.location.replace('{{ route('admin.news.comment.index') }}');
									} else {
										$this.prop('disabled', false);
									}
								}, 'json').fail(function (jqXhr) {
									if (jqXhr.status === 401) //redirect if not authenticated user.
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
								$('#frm1')[0].reset();
							});
						});
					</script>
					@endpush
				</div>
			</form>
		</div>
	</div>
@endsection


@push('script')
<script type="text/javascript" src="{{ asset('assets/js/jalaali.js')  }}"></script>
@endpush
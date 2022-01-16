@extends('_layouts.admin')
@section('menu_active', 'staticpage')

@section('title', 'ایجاد صفحه ی جدید')

@section('page-bar')
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<a href="{{ route('admin.staticpage.index') }}">لیست صفحات</a> <i class="fa fa-angle-double-left"></i>
		</li>
		<li>
			<span>ایجاد صفحه ی جدید</span>
		</li>
	</ul>
	<div class="page-toolbar">
		<div class="btn-group pull-right">
			<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="{{ route('admin.staticpage.index') }}"> <i class="fa fa-check"></i> لیست صفحات</a>
				</li>
			</ul>
		</div>
	</div>
@endsection

@section('content')
	<h3 class="page-title"> ایجاد صفحه ی جدید:
		<small>از طریق فرم زیر اقدام به تعریف صفحه جدید نمایید.</small>
	</h3>

	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption font-green-haze">
				<i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ایجاد صفحه ی جدید</span>
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
				<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.staticpage.index') }}" title="بازگشت" > <i class="fa fa-arrow-left"></i> </a>
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

							<div class="form-group">
								<label class="control-label" for="input_summary"><span class="text-danger">*</span> خلاصه مطلب:</label>
								<div class="input-icon">
									<i class="fa fa-bell-o"></i> <textarea class="form-control" name="summary" id="input_summary" rows="3"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label" for="input_text"><span class="text-danger">*</span> متن:</label> <textarea class="ckeditor form-control" name="text" id="input_text" rows="6"></textarea>
								@push('script_lib')
								<script src="{{ asset('assets/plugins/ckeditor-4.4.5/ckeditor.js') }}"></script>
								@endpush

								@push('script')
								<script>
									CKEDITOR.replace('input_text', {
										language: '{{ config('app.locale') }}'
									});
									function processFileEditor(file) {
										fi = '{{url('')}}' + file.url;
										fi = file;
										$('[id^="cke_Upload_"]').each(function () {
											$(this).remove();
										});
										$('.cke_dialog_ui_input_text').each(function () {
											if ($(this).is(':visible')) {
												$(this).children().val(fi);
												a = $('.ImagePreviewBox td a')[0].outerHTML;
												$('.ImagePreviewBox td').html(a);
												$('.ImagePreviewBox a img').attr('style','');
												$('.ImagePreviewBox a img').attr('src',fi);
												return false;
											}
										});
									}
								</script>
								@endpush
							</div>


                            @push('script')
                            <link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
                            <script type="text/javascript" src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>
                            <script type="text/javascript" src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
                            <script type="application/javascript">
                                $(document).ready(function() {
                                    $('#file_pic').val();

                                    $("#fileuploader").uploadFile({
                                        url: "{{ route('upload_file') }}",
                                        formData: {"upload_dir": "files", "thumb": "no",'_token':'{{ csrf_token() }}' },
                                        showStatusAfterSuccess: false,
                                        showAbort: false,
                                        showDone: false,
                                        allowedTypes: "jpg,jpeg,png",
                                        fileName: "myfile",
                                        returnType: 'json',
                                        dataType: 'json',
                                        onSubmit: function (files) {
                                        },
                                        onSuccess: function (files, data, xhr) {
                                            var json_data = JSON.stringify(data);
                                            var new_data = data[0].filename;
                                            $("#file_pic").val(new_data);
                                            var resp = data[0].filename;
                                            var resp_org = data[0].org_filename;

                                            $('.msg').append('<li>فایل '+ resp_org +' به درستی ارسال شد.</li>');

                                        },
                                        afterUploadAll: function () {
                                        },
                                        onError: function (files, status, errMsg) {
                                            $("#eventsmessage").html($("#eventsmessage").html() + "<br/>Error for: " + JSON.stringify(files));
                                        }
                                    });
                                });
                            </script>
                            @endpush

                            <div class="form-group">
                                <label class="control-label">تصویر مطلب:</label>
                                <div>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group input-group-fixed">
                                            <div id="fileuploader">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i>انتخاب فایل</span>
                                            </div>
                                            <input type="hidden" id="file_pic" name="file_pic" value="" >
                                            <div class="msg">
                                            </div>
                                            <div id="eventsmessage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

						</div>

						<div class="col-md-3">


                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    انتخاب زبان :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="lang" id="lang">
                                        @foreach(config('app.locales') as $key=>$lang)
                                            <option value="{{ $key }}">{{ $lang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

							<div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
محل نمایش :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="show_part" id="show_part">
                                        <option value="menu">منو</option>
                                        <option value="service">سرویس ها</option>
                                        <option value="agencies">نمایندگی ها</option>
										<option value="ads">گالری</option>
                                        {{--<option value="menu_service">منو و سرویس ها</option>--}}
                                        <option value="footer">پایین صفحه( Footer )</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input_service_id"><span class="text-danger">*</span> زیر منو :</label>
                                <i class="fa fa-question"></i>
                                <select class="form-control" name="sub_cat" id="sub_cat">
                                    <option value="0">دسته بندی اصلی</option>
                                    @foreach($cats as $key=>$val)
                                        <option value="{{ $val->id }}">{{ $val->title }}
                                            [
                                            {{ config('define.lang.'.$val->lang) }}
                                            ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>


							<div class="form-group clearfix">
								<label class="control-label" for="input_tags">تگ:</label>
								<select name="tags[]" id="input_tags" class="form-control" multiple></select>

								@push('style')
								<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
								<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
								@endpush

								@push('script_lib')
								<script src="{{ asset('assets/plugins/select2_4.0.0/js/select2.min.js') }}"></script>
								<script src="{{ asset('assets/plugins/select2_4.0.0/js/i18n/fa.js') }}"></script>
								@endpush

								@push('script')
								<script>
									$(document).ready(function () {
										$('#input_tags').select2({
											dir: 'rtl',
											tags: true,
											placeholder: '{{ Lang::get('custom.tag_placeholder') }}',
											language: '{{ config('app.locale') }}',
											ajax: {
												url: '{{ route('admin.tag.items') }}',
												type: 'POST',
												dataType: 'json',
												delay: 250,
												data: function (params) {
													return {
														query: params.term, // search term
														page: params.page
													};
												},
												processResults: function (data, params) {
													params.page = params.page || 1;
													var arr = [];
													for (var i in data.rows) {
														arr.push({
															id: data.rows[i].title,
															text: data.rows[i].title,
															_raw: data.rows[i]  // for convenience
														});
													}
													return {
														results: arr,
														pagination: {
															more: (params.page * 30) < data.total
														}
													};
												},
												cache: true
											},
											escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
											minimumInputLength: 2
										});
									});
								</script>
								@endpush
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions">
					<button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
					<button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
					<a href="{{ route('admin.staticpage.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
					@push('style')
					<link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
					@endpush
					@push('script')
					<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
					<script>
						$(document).ready(function(){
						    $('#show_part').change(function () {
								if($(this).val()=='menu'){
                                    $('#sub_cat').parent().slideDown();
								}
								else {
                                    $('#sub_cat').parent().slideUp();
								}
                            });
							$('.btnFromSave').click(function () {
								var $this = $(this).prop('disabled', true);
								var $form = $('#frm1');
								$form.find('.has-error').removeClass('has-error');
								$form.find('.help-block').remove();
								CKEDITOR.instances['input_text'].updateElement();
								$.post('{{ route('admin.staticpage.store') }}', $form.serialize(), function (data) {
									if (data.ok) {
										window.location.replace('{{ route('admin.staticpage.index') }}');
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
@extends('_layouts.admin')
@section('menu_active', 'ads')

@section('title', 'ویرایش تبلیغ ')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i
                    class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <a href="{{ route('admin.ads.index') }}">لیست تبلیغات</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>ویرایش تبلیغ </span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.ads.index') }}"> <i class="fa fa-check"></i> لیست تبلیغات</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> ویرایش تبلیغ :
        <small>از طریق فرم زیر اقدام به ویرایش تبلیغ نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span
                        class="caption-subject bold uppercase"> ویرایش تبلیغ </span>
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
                            <a href="javascript:;" class="btnFromReset"> <i class="fa fa-trash-o"></i> پاک کردن اطلاعات
                                جاری</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                   title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips"
                                              href="{{ route('admin.ads.index') }}" title="بازگشت"> <i
                            class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="edit_id" value="{{ $ads->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-9">

                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span> تیتر:</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <input type="text" value="{{ $ads->title }}"
                                                                        class="form-control" name="title"
                                                                        id="input_title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input_link"><span class="text-danger">*</span> لینک :</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <input style="direction: ltr"  type="text" value="{{ $ads->link }}"
                                                                        class="form-control" name="link"
                                                                        id="input_link">
                                </div>
                            </div>


                            @push('script')
                                <link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
                                <script type="text/javascript"
                                        src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>
                                <script type="text/javascript"
                                        src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
                                <script type="application/javascript">
                                    $(document).ready(function () {
                                        $('#file_pic').val('{{ $ads->image_url }}');
                                        $('#lang').val('{{ $ads->lang }}');
                                        $('#status').val('{{ $ads->status }}');

                                        $("#fileuploader").uploadFile({
                                            url: "{{ route('upload_file') }}",
                                            formData: {
                                                "upload_dir": "files",
                                                "thumb": "no",
                                                '_token': '{{ csrf_token() }}'
                                            },
                                            showStatusAfterSuccess: false,
                                            showAbort: false,
                                            showDone: false,
                                            allowedTypes: "jpg,jpeg,png,gif",
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

                                                $('.msg').append('<li>فایل ' + resp_org + ' به درستی ارسال شد.</li>');

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
                                <label class="control-label">تصویر تبلیغ :</label>
                                <div>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group input-group-fixed">
                                            <div id="fileuploader">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i>انتخاب فایل</span>
                                            </div>
                                            <input type="hidden" id="file_pic" name="file_pic" value="">
                                            <div class="msg">
                                                @if( !empty($ads->image_url) )
                                                    <img style="padding: 10px; border: 1px solid lightslategray; margin: 7px; width: 40%;"
                                                         src="{{ url('files/'.$ads->image_url ) }}" alt="">
                                                @endif
                                            </div>
                                            <div id="eventsmessage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group" style="">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    انتخاب جایگاه :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="location" id="location">
                                        <option value="left"> چپ </option>
                                        <option value="top">بالا</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group" style="display: none">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    انتخاب زبان :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="lang" id="lang">
                                        @foreach(config('define.lang') as $key=>$lang)
                                            <option value="{{ $key }}">{{ $lang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--                            @include('partials.date',['field_title' => 'تاریخ درج تبلیغ ', 'field_name' => 'date' , 'data'=> jdate($ads->created_at)->format('Y/m/d H:i:s') ,'star'=>true])--}}

                            <div class="form-group" style="">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    وضعیت :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="status" id="status">
                                        <option value="active">فعال</option>
                                        <option value="deactive">غیر فعال</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
                    <button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
                    <a href="{{ route('admin.ads.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
                    @push('style')
                        <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet"
                              type="text/css"/>
                    @endpush
                    @push('script')
                        <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}"
                                type="text/javascript"></script>
                        <script>
                            $(document).ready(function () {
                                $('#location').val('{{ $ads->location }}');
                                $('#cat').val('{{ $ads->cat_id }}');
                                $('.btnFromSave').click(function () {
                                    var $this = $(this).prop('disabled', true);
                                    var $form = $('#frm1');
                                    $form.find('.has-error').removeClass('has-error');
                                    $form.find('.help-block').remove();
                                    // CKEDITOR.instances['input_text'].updateElement();
                                    $.post('{{ route('admin.ads.update') }}', $form.serialize(), function (data) {
                                        if (data.ok) {
                                            window.location.replace('{{ route('admin.ads.index') }}');
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
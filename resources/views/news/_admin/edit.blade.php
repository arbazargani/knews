@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', 'ویرایش خبر ')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i
                    class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <a href="{{ route('admin.news.index') }}">لیست اخبار</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>ویرایش خبر </span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.news.index') }}"> <i class="fa fa-check"></i> لیست اخبار</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> ویرایش خبر :
        <small>از طریق فرم زیر اقدام به ویرایش خبر  نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span
                        class="caption-subject bold uppercase"> ویرایش خبر </span>
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
                                              href="{{ route('admin.news.index') }}" title="بازگشت"> <i
                            class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="edit_id" value="{{ $news->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-9">

                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span> تیتر:</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <input type="text" value="{{ $news->title }}"
                                                                        class="form-control" name="title"
                                                                        id="input_title">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="input_summary">
                                    خلاصه متن:</label>
                                <div class="input-icon">
                                    <i class="fa fa-bell-o"></i> <textarea class="form-control" name="summary"
                                                                           id="input_summary"
                                                                           rows="3">{{ $news->descr }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input_text"><span class="text-danger">*</span>
                                    متن:</label> <textarea class="ckeditor form-control" name="text" id="input_text"
                                                           rows="6">{{ $news->full_text }}</textarea>
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
                                                $('.ImagePreviewBox a img').attr('style', '');
                                                $('.ImagePreviewBox a img').attr('src', fi);
                                                return false;
                                            }
                                        });
                                    }
                                </script>
                                @endpush
                            </div>


                            @push('script')
                            <link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
                            <script type="text/javascript"
                                    src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>
                            <script type="text/javascript" src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
                            <script type="application/javascript">
                                $(document).ready(function () {
                                    $('#file_pic').val('{{ $news->image_url }}');
                                    $('#lang').val('{{ $news->lang }}');

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
                                        allowedTypes: "jpg,jpeg",
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
                                <label class="control-label">تصویر خبر :</label>
                                <div>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-group input-group-fixed">
                                            <div id="fileuploader">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i>انتخاب فایل</span>
                                            </div>
                                            <input type="hidden" id="file_pic" name="file_pic" value="">
                                            <div class="msg">
                                                @if( !empty($news->image_url) )
                                                    <img style="padding: 10px; border: 1px solid lightslategray; margin: 7px; width: 40%;"
                                                         src="{{ url('files/'.$news->image_url ) }}" alt="">
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

                            @include('partials.date',['field_title' => 'تاریخ درج خبر ', 'field_name' => 'date' , 'data'=> jdate($news->created_at)->format('Y/m/d H:i:s') ,'star'=>true])

                            <div class="form-group" style="display: none">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    قرارگیری در اسلایدر :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="slider" id="slider">
                                        <option value="no">خیر</option>
                                        <option value="yes">بله</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="input_service_id"><span class="text-danger">*</span> انتخاب دسته بندی</label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <select class="form-control" name="type" id="type">
                                        <option value="titr1"> تیتر 1 </option>
                                        <option value="titr2"> تیتر 2 </option>
                                        <option value="titr3"> تیتر 3 </option>
                                    </select>
                                </div>
                            </div>

                             <div class="form-group" style="display: none">
                                 <label class="control-label" for="input_service_id"><span class="text-danger">*</span> انتخاب دسته بندی</label>
                                 <div class="input-icon">
                                     <i class="fa fa-question"></i>
                                     <select class="form-control" name="cat" id="cat">
                                         <option value="">انتخاب دسته بندی</option>
                                         @foreach($cats as $key=>$val)
                                             <option value="{{ $val->id }}">{{ $val->title }}
                                                 [
                                                     {{ config('define.lang.'.$val->lang) }}
                                                 ]
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>


                            <div class="form-group clearfix">
                                <label class="control-label" for="input_tags">تگ:</label>
                                <select name="tags[]" id="input_tags" class="form-control" multiple>
                                    @if($news->tags != '')
                                        @foreach(\App\Tag::whereIn('id',explode(',', $news->tags))->get() as $key => $value)
                                            <option value="{{ $value->title }}" selected>{{ $value->title }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @push('style')
                                <link href="{{ asset('assets/plugins/select2_4.0.0/css/select2.min.css') }}"
                                      rel="stylesheet" type="text/css"/>
                                <link href="{{ asset('assets/plugins/select2_4.0.0/css/select2-bootstrap.min.css') }}"
                                      rel="stylesheet" type="text/css"/>
                                @endpush

                                @push('script_lib')
                                <script src="{{ asset('assets/plugins/select2_4.0.0/js/select2.min.js') }}"></script>
                                <script src="{{ asset('assets/plugins/select2_4.0.0/js/i18n/fa.js') }}"></script>
                                @endpush

                                @push('script')
                                <script>
                                    $(document).ready(function () {
                                        $('#type').val('{{ $news->type }}');
                                        $('#slider').val('{{ $news->slider }}');
                                        $('#input_tags').select2({
                                            dir: 'rtl',
											@if(\Auth::user()->isadmin == 'yes')
                                            tags: true,
											@else
                                            tags: false,
											@endif
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
                                            escapeMarkup: function (markup) {
                                                return markup;
                                            }, // let our custom formatter work
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
                    <a href="{{ route('admin.news.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
                    @push('style')
                    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet"
                          type="text/css"/>
                    @endpush
                    @push('script')
                    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}"
                            type="text/javascript"></script>
                    <script>
                        $(document).ready(function () {
                            $('#cat').val('{{ $news->cat_id }}');
                            $('.btnFromSave').click(function () {
                                var $this = $(this).prop('disabled', true);
                                var $form = $('#frm1');
                                $form.find('.has-error').removeClass('has-error');
                                $form.find('.help-block').remove();
                                CKEDITOR.instances['input_text'].updateElement();
                                $.post('{{ route('admin.news.update') }}', $form.serialize(), function (data) {
                                    if (data.ok) {
                                        window.location.replace('{{ route('admin.news.index') }}');
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
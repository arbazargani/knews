@extends('_layouts.admin')
@section('menu_active', 'course')
@section('title', 'ویرایش درس ')

@push('style')
<link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@push('script')
<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.course.index') }}">پیشخوان</a> <i
                    class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>
                ویرایش درس
            </span>
        </li>
    </ul>
    {{--<div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#"> <i class="icon-user"></i> لیست نظرسنجی ها</a>
                </li>
            </ul>
        </div>
    </div>--}}
@endsection

@section('content')
    <h3 class="page-title">ویرایش درس:
        <small>از طریق فرم زیر اقدام به ویرایش درس نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span
                        class="caption-subject bold uppercase">ویرایش درس </span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <button class="btn green btnFromSave">
                        <i class="fa fa-check"></i> ارسال
                    </button>

                    @push('script')
                    <script>
                        $(document).ready(function () {
                            $('.btnFromSave').click(function () {
                                var $this = $(this).prop('disabled', true);
                                var $form = $('#frm1');
                                $form.find('.has-error').removeClass('has-error');
                                $form.find('.help-block').remove();
                                img = cjson_img('.upbox-thumb');
                                CKEDITOR.instances['input_text'].updateElement();
                                if (img == '{}')
                                    img = '';
                                $.post('{{ route('admin.course.store.edit') }}',
                                    $form.serialize() + '&img=' + img,
                                    function (data) {
                                        if (data.ok) {
                                            window.location.replace('{{ route('admin.course.index') }}');
                                        } else {
                                            $this.prop('disabled', false);
                                            toastr.error(data.message);
                                        }
                                    }, 'json').fail(function (jqXhr) {
                                    if (jqXhr.status === 401) //redirect if not authenticated user.
                                        window.location.replace('{{ route('login') }}');
                                    else if (jqXhr.status === 422) {
                                        $.each(jqXhr.responseJSON, function (key, value) {
                                            //$('#input_' + key).after('<span class="help-block"> <strong>' + value[0] + '</strong> </span>').closest('.form-group').addClass('has-error');
                                            toastr.error(value);
                                        });
                                        $this.prop('disabled', false);
                                    } else
                                        $this.prop('disabled', false);
                                });
                            });
                        });
                    </script>
                    @endpush


                </div>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                   title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips"
                                              href="#" title="بازگشت"> <i
                            class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST">
                <input type="hidden" name="edit_id" value="{{ $course->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-9">

                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger">*</span>
                                    عنوان درس :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i> <input type="text" value="{{ $course->title }}"
                                                                          class="form-control" name="title"
                                                                          id="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input_title"><span class="text-danger"></span>
                                    خلاصه ی درس :
                                </label>
                                <div class="input-icon">
                                    <i class="fa fa-question"></i>
                                    <textarea name="descr" id="descr" cols="30" rows="5"
                                              class="form-control">{{ $course->descr }}</textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input_text"><span class="text-danger">*</span>
                                    متن:</label> <textarea class="ckeditor form-control" name="text" id="input_text"
                                                           rows="6">{{ $course->fulltext }}</textarea>
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
                                        $('[id^="cke_Upload_"]').each(function () {
                                            $(this).remove();
                                        });
                                        $('.cke_dialog_ui_input_text').each(function () {
                                            if ($(this).is(':visible')) {
                                                $(this).children().val(fi);
                                                return false;
                                            }
                                        });
                                    }
                                    var count_file_select = 10;
                                    function processFile(file) {
                                        $.each(file, function (index, value) {
                                            ii = parseInt(index) + count_file_select;
                                            $('.upbox-thumb').append('<div data-sort="' + ii + '" class="thumb-div div_' + ii + ' ">' +
                                                '<img alt="" src="' + value.url + '" data-val="' + value.url + '" class="thumb-img">' +
                                                '<input type="text" value="" class="txt_' + ii + '" style="margin: 5px;">' +
                                                '<span class="thumb-span" data-snattr="' + ii + '">' +
                                                '	<i class="icon-close"></i>' +
                                                '</span>' +
                                                '</div>');
                                            count_file_select++;
                                        });
                                        fi = '' + file.url;
                                        count_file_select *= 2;
                                    }


                                    $(document).on('click', '.thumb-span', function () {
                                        var remove_div = $(this).attr('data-snattr');
                                        $('.upbox-thumb').find('.div_' + remove_div).slideUp('slow').remove();
                                    });

                                    function cjson_img(ndiv) {
                                        jsons = '{';
                                        $(ndiv).find('img').each(function (index, item) {
                                            jsons += '"' + index + '":{"caption":"' + $('.txt_' + $(this).parent().attr('data-sort')).val().trim() + '","file":"' + $(this).attr('data-val') + '"},';
                                        });
                                        jsons = jsons + '}';
                                        jsons = jsons.replace(/,}/gi, "}");
                                        return jsons;
                                    }


                                    $(document).on('click', '.btnRemoveGalleryPreview', function () {
                                        $(this).parent().parent().fadeOut('fast', function () {
                                            var $this = $(this);
                                            $this.remove();
                                        });
                                    });

                                </script>
                                @endpush
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label" for="input_gallery">گالری تصاویر:</label>
                                <button type="button" id="btnGallerySelect" class="btn green btn-outline"><i
                                            class="fa fa-plus"></i> اضافه کردن فایل...
                                </button>
                                <input type="hidden" id="input_gallery" value="">

                                <div class="col-md-12 upbox-thumb"
                                     data-placeholder="ui-state-highlight"
                                     data-handle=".cfi-content" data-tolerance="pointer"
                                     data-update=""
                                     data-posturl="">
                                    @foreach( json_decode($course->imgs , true) as $key=>$val )
                                        <div data-sort="{{ $key }}" class="thumb-div div_{{ $key }}">
                                            <img alt="" src="{{ url($val['file']) }}" data-val="{{ url($val['file']) }}"
                                                 class="thumb-img">
                                            <input type="text" value="{{ $val['caption'] }}" class="txt_{{ $key }}"
                                                   style="margin: 5px;">
                                            <span class="thumb-span" data-snattr="{{ $key }}">
                                                <i class="icon-close"></i>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                @push('script')
                                <style>
                                    .thumb-div {
                                        border: 1px solid;
                                        margin: 10px;
                                        padding: 10px;
                                    }
                                </style>
                                <script type="text/javascript"
                                        src="{{ asset('assets/plugins/jquery.popupWindow.js') }}"></script>
                                <script>
                                    $(document).ready(function () {
                                        $('#btnGallerySelect').popupWindow({
                                            windowURL: '{{ route('admin.filemanager.multiple') }}',
                                            windowName: 'Filebrowser',
                                            height: 420,
                                            width: 950,
                                            centerScreen: 1
                                        });
                                    });
                                </script>
                                @endpush
                            </div>


                            <div class="form-group clearfix">
                                <label class="control-label" for="input_gallery">ارسال ویدیو :</label>
                                <button type="button" id="button_form_vid" class="btn green btn-outline"><i
                                            class="fa fa-plus"></i> اضافه کردن فایل...
                                </button>
                                <input type="hidden" id="videoUrl" name="videoUrl" value="{{ $course->video }}">
                                <div class="col-md-12 upbox-vid" style="margin-top:20px ">
                                    @if( !empty($course->video) )
                                        <object width="450" height="350" id="player"
                                                classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">
                                            <param name="movie" value="{{ url('assets/media/player.swf') }}">
                                            <param name="allowfullscreen" value="true">
                                            <param name="allowscriptaccess" value="always">
                                            <param name="flashvars"
                                                   value="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">
                                            <embed width="450" height="350" type="application/x-shockwave-flash"
                                                   id="player2" name="player2"
                                                   src="{{ url('assets/media/player.swf') }}" allowscriptaccess="always"
                                                   allowfullscreen="true"
                                                   flashvars="file={{ url($course->video) }}?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">
                                        </object>
                                    @endif
                                </div>

                                @push('script')
                                <script>
                                    $(document).ready(function () {
                                        $('#button_form_vid').popupWindow({
                                            windowURL: '{{ route('admin.filemanager.vid') }}',
                                            windowName: 'Filebrowser',
                                            height: 420,
                                            width: 950,
                                            centerScreen: 1
                                        });
                                    });


                                    function processFileVid(file) {
                                        typefile = file.name.split('.');
                                        typefile = typefile[typefile.length - 1];
                                        if (typefile == 'mp4' || typefile == 'flv') {
                                            $('.upbox-vid').html('<object width="450" height="350" id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player">\
	<param name="movie" value="' + base_url + 'assets/media/player.swf">\
	<param name="allowfullscreen" value="true">\
	<param name="allowscriptaccess" value="always">\
	<param name="flashvars" value="file=' + base_url + file.url + '?mode=player&amp;type=video&amp;logo=' + base_url + 'logo.png&amp;image=/pages/">\
	<embed width="450" height="350" type="application/x-shockwave-flash" id="player2" name="player2" src="' + base_url + 'assets/media/player.swf" allowscriptaccess="always" allowfullscreen="true" flashvars="file=' + base_url + file.url + '?mode=player&amp;type=video&amp;logo=' + base_url + 'assets/media/logo.png&amp;image=/pages/">\
</object>');
                                            $('#videoUrl').val(file.url);
                                        }
                                        else {
                                            toastr.error('فایل انتخابی باید mp4 یا flv  باشد.');
                                        }
                                    }
                                </script>
                                @endpush
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" for="input_gallery">ارسال صوت :</label>
                                <button type="button" id="button_form_audio" class="btn green btn-outline"><i
                                            class="fa fa-plus"></i> اضافه کردن فایل...
                                </button>
                                <input type="hidden" id="audioUrl" name="audioUrl" value="{{ $course->audio }}">
                                <div class="col-md-12 upbox-audio" style="margin-top:20px ">
                                    @if(!empty($course->audio))
                                        <object width="400" height="20" data="{{ url('assets/media/player_mp3.swf') }}"
                                                type="application/x-shockwave-flash">
                                            <param value="{{ url('assets/media/player_mp3.swf') }}" name="movie">
                                            <param value="#ffffff" name="bgcolor">
                                            <param value='mp3={{ url($course->audio) }}&amp;loop=0&amp;showvolume=1&amp;showstop=1&amp;'
                                                   name="FlashVars">
                                        </object>
                                    @endif
                                </div>

                                @push('script')
                                <script>
                                    $(document).ready(function () {
                                        $('#button_form_audio').popupWindow({
                                            windowURL: '{{ route('admin.filemanager.audio') }}',
                                            windowName: 'Filebrowser',
                                            height: 420,
                                            width: 950,
                                            centerScreen: 1
                                        });
                                    });
                                    function processFileaudio(file) {
                                        typefile = file.name.split('.');
                                        typefile = typefile[typefile.length - 1];
                                        if (typefile == 'mp3') {
                                            $('.upbox-audio').html('<object width="400" height="20" data="' + base_url + 'assets/media/player_mp3.swf" type="application/x-shockwave-flash">\
							<param value="' + base_url + 'assets/media/player_mp3.swf" name="movie">\
							<param value="#ffffff" name="bgcolor">\
							<param value=\'mp3=' + base_url + file.url + '&amp;loop=0&amp;showvolume=1&amp;showstop=1&amp;\' name="FlashVars"></object>');

                                            $('#audioUrl').val(file.url);
                                        }
                                        else {
                                            toastr.error('فایل انتخابی باید mp3 باشد.');
                                        }
                                    }
                                </script>
                                @endpush
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" for="input_gallery">ارسال فایل پیوست :</label>
                                <button type="button" id="button_form_file" class="btn green btn-outline"><i
                                            class="fa fa-plus"></i> اضافه کردن فایل...
                                </button>
                                <input type="hidden" id="filesUrl" name="filesUrl" value="{{ $course->files }}">
                                <div class="col-md-12 upbox-files" style="margin-top:20px ; margin-right: 20px ">
                                    @if(!empty($course->files))
                                        @foreach( json_decode($course->files , true) as $val )
                                            <li style="margin-bottom: 5px;"><a style="width: 10%; height: 10%;"
                                                                               snattr="{{ $val }}"
                                                                               href="{{ $val }}">{{ $val }}</a><i
                                                        class="icon-remove del_doc"
                                                        style="padding-left: 4px;cursor: pointer;"></i></li>
                                        @endforeach
                                    @endif
                                </div>

                                @push('script')
                                <script>
                                    $(document).ready(function () {
                                        $('#button_form_file').popupWindow({
                                            windowURL: '{{ route('admin.filemanager.files') }}',
                                            windowName: 'Filebrowser',
                                            height: 420,
                                            width: 950,
                                            centerScreen: 1
                                        });
                                    });
                                    function processFilesDoc(file) {
                                        jQuery.each(file, function (index, item) {
                                            typefile = item.name.split('.');
                                            typefile = typefile[typefile.length - 1];
                                            if (typefile == 'doc' || typefile == 'docx' || typefile == 'pdf' || typefile == 'zip' || typefile == 'rar') {
                                                var sp = item.url;
                                                sp = sp.split('/');
                                                spl = sp.length;
                                                $('.upbox-files').append('<li style="margin-bottom: 5px;"><a style="width: 10%; height: 10%;" snattr="' + item.url + '" href="' + base_url + item.url + '" >' + decodeURI(sp[spl - 1]) + '</a><i class="icon-remove del_doc" style="padding-left: 4px;cursor: pointer;"></i></li>');
                                            }
                                            else {
                                                toastr.error('فایل انتخابی باید doc یا docx یا pdf یا zip یا rar باشد.');
                                            }
                                        });
                                        $('#filesUrl').val(docjson('.upbox-files'));
                                    }

                                    function docjson(ndiv) {
                                        jsons = '{';
                                        $(ndiv).find('a').each(function (index, item) {
                                            jsons += '"' + index + '":"' + $(this).attr('snattr') + '",';
                                        });
                                        jsons = jsons + '}';
                                        jsons = jsons.replace(/,}/gi, "}");
                                        if (jsons == '{}') jsons = '';
                                        return jsons;
                                    }


                                </script>
                                @endpush
                            </div>


                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="input_service_id"><span
                                                    class="text-danger">*</span>
                                            انتخاب دسته بندی
                                        </label>
                                        <select name="type[]" id="type" style="width: 100%"
                                                class="form-control input_popover input_select2" multiple>
                                            @foreach($moduleCat as $val)
                                                <option value="{{ $val->id }}">{{ $val->title }}
                                                    [
                                                    {{ config('define.lang.'.$val->lang) }}
                                                    ]
                                                </option>
                                            @endforeach
                                        </select>

                                        @push('style')
                                        <link href="{{ asset('assets/plugins/select2_4.0.0/css/select2.min.css') }}"
                                              rel="stylesheet" type="text/css"/>
                                        <link href="{{ asset('assets/plugins/select2_4.0.0/css/select2-bootstrap.min.css') }}"
                                              rel="stylesheet" type="text/css"/>
                                        @endpush

                                        @push('script')
                                        <script src="{{ asset('assets/plugins/select2_4.0.0/js/select2.min.js') }}"></script>
                                        <script src="{{ asset('assets/plugins/select2_4.0.0/js/i18n/fa.js') }}"></script>
                                        <script>
                                            $(document).ready(function () {
                                                $('#lang').val('{{ $course->lang }}');
                                                $('#show_last').val('{{ $course->show_last }}');
                                                $("#type").val([{!! $course->cats !!}]).trigger("change");
                                                $('.input_select2').select2({
                                                    dir: "rtl",
                                                    language: "fa"
                                                });
                                            });
                                        </script>
                                        @endpush

                                    </div>


                                    <div class="form-group">
                                        <label class="control-label" for="input_title">
                                            اولویت نمایش :
                                        </label>
                                        <div class="input-icon">
                                            <i class="fa fa-question"></i> <input type="text"
                                                                                  value="{{ $course->show_order }}"
                                                                                  class="form-control" name="show_order"
                                                                                  id="show_order">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="input_title">
                                            انتخاب زبان :
                                        </label>
                                        <select class="form-control" name="lang" id="lang">
                                            @foreach(config('define.lang') as $key=>$lang)
                                                <option value="{{ $key }}">{{ $lang }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @include('partials.text' , ['field_title' => 'قیمت'.' ( ریال ) ' , 'field_name' => 'prices','star'=>true , 'data'=>$course->price])


                                </div>
                            </div>
                            {{--

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="input_service_id"><span class="text-danger">*</span>
                            تاریخ انتشار :
                                                                    </label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon" data-MdDateTimePicker="true" data-targetselector="#input_publish_at" data-trigger="click" data-enabletimepicker="true">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </div>
                                                                        <input style="text-align: center; direction: ltr;" readonly data-mddatetimepicker="true" data-enabletimepicker="true"  data-placement="right" type="text" class="form-control" name="publish_at" id="input_publish_at" placeholder="تاریخ به همراه زمان" />
                                                                    </div>
                                                                    @push('style')
                                                                    <link rel="stylesheet" type="text/css"
                                                                          href="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}">
                                                                    @endpush

                                                                    @push('script_lib')
                                                                    <script type="text/javascript"
                                                                            src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js')  }}"></script>
                                                                    <script type="text/javascript"
                                                                            src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/calendar.js')  }}"></script>
                                                                    @endpush

                                                                </div>

                                                            </div>
                                                        </div>
                            --}}

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn green btnFromSave"><i class="fa fa-check"></i> ارسال</button>
                </div>
            </form>
        </div>
    </div>
@endsection
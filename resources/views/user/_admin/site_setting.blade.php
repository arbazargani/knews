@extends('_layouts.admin')
@section('menu_active', 'dashboard')

@section('title', 'تنظیمات')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>تنظیمات</span>
        </li>
    </ul>
@endsection

@section('content')
    <h3 class="page-title"> تنظیمات:
        {{--<small>از طریق فرم زیر اقدام به تعریف کاربر جدید نمایید.</small>--}}
    </h3>

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> تنظیمات</span>
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
                            <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.users.index') }}" title="بازگشت"> <i class="fa fa-arrow-left"></i> </a>
                        </form>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="frm1" role="form" method="POST" autocomplete="off">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ متن منو</label>
                                                <input type="text" name="color" id="color" dir="ltr" class="form-control demo" data-control="hue" value="{{ $site_setting->color_menu }}">
                                            </div>
                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ پس زمینه منو</label>
                                                <input type="text" name="bk_color" dir="ltr" id="bk_color" class="form-control demo" data-control="hue" value="{{ $site_setting->bk_color_menu }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ پس زمینه فوتر</label>
                                                <input type="text" name="bk_color_footer" dir="ltr" id="bk_color_footer" class="form-control demo" data-control="hue" value="{{ $site_setting->bk_color_footer }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ متن فوتر</label>
                                                <input type="text" name="color_footer" id="color_footer" dir="ltr" class="form-control demo" data-control="hue" value="{{ $site_setting->color_footer }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ عنوان متن فوتر</label>
                                                <input type="text" name="title_color_footer" id="title_color_footer" dir="ltr" class="form-control demo" data-control="hue" value="{{ $site_setting->title_color_footer }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label">رنگ متن فوتر( hover )</label>
                                                <input type="text" name="hover_color_footer" id="hover_color_footer" dir="ltr" class="form-control demo" data-control="hue" value="{{ $site_setting->hover_color_footer }}">
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

                            @push('style')

                            <link href="{{ url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css') }}" rel="stylesheet" type="text/css" />
                            <link href="{{ url('assets/global/plugins/jquery-minicolors/jquery.minicolors.css') }}" rel="stylesheet" type="text/css" />

                            @endpush

                            @push('script')

                            <script src="{{ url('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
                            <script src="{{ url('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js') }}" type="text/javascript"></script>


                            <script>
                                $(document).ready(function () {

                                    $('#bk_color').colorpicker({
                                        color: "{{ $site_setting->bk_color_menu }}",
                                        horizontal: true
                                    });
                                    $('#color').colorpicker({
                                        color: "{{ $site_setting->color_menu }}",
                                        horizontal: true
                                    });

                                    $('#bk_color_footer').colorpicker({
                                        color: "{{ $site_setting->bk_color_footer }}",
                                        horizontal: true
                                    });
                                    $('#color_footer').colorpicker({
                                        color: "{{ $site_setting->color_footer }}",
                                        horizontal: true
                                    });
                                    $('#title_color_footer').colorpicker({
                                        color: "{{ $site_setting->title_color_footer }}",
                                        horizontal: true
                                    });
                                    $('#hover_color_footer').colorpicker({
                                        color: "{{ $site_setting->hover_color_footer }}",
                                        horizontal: true
                                    });

                                    $('.btnFromSave').click(function () {
                                        var $this = $('.btnFromSave').prop('disabled', true);
                                        var $form = $('#frm1');
                                        $form.find('.has-error').removeClass('has-error');
                                        $form.find('.help-block').remove();
                                        $.post('{{ route('admin.site.setting.post') }}', $form.serialize(), function (data) {
                                            if (data.ok) {
                                                window.location.replace('{{ route('admin.site.setting') }}');
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
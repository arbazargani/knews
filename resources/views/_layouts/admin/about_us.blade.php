@extends('_layouts.admin')
@section('menu_active', 'contactus')

@section('title', 'درباره ما')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>درباره ما</span>
        </li>
    </ul>

@endsection

@section('content')
    <h3 class="page-title"> درباره  ما:
        <small>از طریق فرم زیر اقدام به تغییر اطلاعات درباره ما نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> درباره ما </span>
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
                        <li>
                            <a href="javascript:;" class="btnFromReset"> <i class="fa fa-trash-o"></i> پاک کردن اطلاعات جاری</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.news.index') }}" title="بازگشت" > <i class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST" autocomplete="off">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-9">

                            @include('partials.text' , ['field_title' => 'آدرس' , 'field_name' => 'address','star'=>true, 'data' => $aboutus->address ])
                            <div style="display: none">
                            @include('partials.fulltext' , ['field_title' => 'توضیحات' , 'field_name' => 'descr', 'data' => $aboutus->descr ])
                            </div>
                            @include('partials.fulltext' , ['field_title' => ' درباره ما' , 'field_name' => 'text', 'data' => $aboutus->fulltext ])

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

                            @include('partials.text' , ['field_title' => 'ایمیل' , 'field_name' => 'email','star'=>true, 'data' => $aboutus->email ])
                            @include('partials.text' , ['field_title' => 'تلفن' , 'field_name' => 'phone','star'=>true, 'data' => $aboutus->phone ])

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
                    <button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
                    <a href="{{ route('admin.news.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
                    @push('style')
                    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
                    <style>
                        #input_phone , #input_email {
                            direction: ltr;
                            text-align: left;
                        }
                    </style>
                    @endpush
                    @push('script')
                    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
                    <script>
                        $(document).ready(function(){
                            $('#lang').val('{{ $aboutus->lang }}');
                            $('#lang').change(function () {
                               window.location.href='{{ route('admin.aboutus',['lang'=>'']) }}/'+$(this).val();
                            });

                            $('.btnFromSave').click(function () {
                                var $this = $(this).prop('disabled', true);
                                var $form = $('#frm1');
                                $form.find('.has-error').removeClass('has-error');
                                $form.find('.help-block').remove();
                                CKEDITOR.instances['descr'].updateElement();
                                CKEDITOR.instances['text'].updateElement();
                                $.post('{{ route('admin.aboutus.post') }}', $form.serialize(), function (data) {
                                    if (data.ok) {
                                        window.location.href='{{ route('admin.aboutus',['lang'=>'']) }}/'+$('#lang').val();
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
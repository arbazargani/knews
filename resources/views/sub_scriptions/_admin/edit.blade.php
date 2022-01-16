@extends('_layouts.admin')
@section('menu_active', 'sub_scriptions')

@section('title', 'ویرایش سرویس')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="{{ route('admin.dashboard') }}">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <a href="{{ route('admin.sub_scriptions.index') }}">لیست سرویس</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>ویرایش سرویس</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.sub_scriptions.index') }}"> <i class="fa fa-check"></i> لیست سرویس</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> ویرایش سرویس:
        <small>از طریق فرم زیر اقدام به ویرایش صفحه نمایید.</small>
    </h3>

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-haze">
                <i class="icon-settings font-green-haze"></i> <span class="caption-subject bold uppercase"> ویرایش سرویس</span>
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
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" title="تمام صفحه"> </a> <a class="btn btn-circle btn-icon-only btn-default tooltips" href="{{ route('admin.sub_scriptions.index') }}" title="بازگشت" > <i class="fa fa-arrow-left"></i> </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form id="frm1" role="form" method="POST" autocomplete="off">
                <input type="hidden" name="edit_id" id="edit_id" value="{{ $news->id }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">

                            @include('partials.text',['field_title' => 'عنوان' , 'field_name' => 'title', 'star'=>true])

                            @include('partials.text',['field_title' => 'تعداد محصولات' , 'field_name' => 'count_product', 'star'=>true])

                            @include('partials.text',['field_title' => 'قیمت پایه سرویس (ریال)' , 'field_name' => 'base_price', 'star'=>true])

                            @include('partials.text',['field_title' => 'قیمت هر محصول اضافه (ریال)' , 'field_name' => 'price_product_addition', 'star'=>true])

                        </div>

                        <div class="col-md-4">

                            @include('partials.select',['field_title' => 'صفحه مخصوص شرکت', 'field_name' => 'special_page', 'data' => [
                                'yes' => 'بله',
                                'no' => 'خیر',
                            ] ,'star'=>true])

                            @include('partials.select',['field_title' => 'بَنر ( slider ) انحصاری', 'field_name' => 'special_page_slider', 'data' => [
                                'yes' => 'بله',
                                'no' => 'خیر',
                            ] ,'star'=>true])

                            @include('partials.select',['field_title' => 'مدت عضویت / ماه ', 'field_name' => 'duration_membership', 'data' => [
                                1 => 1 ,
                                2 => 2,
                                3 => 3,
                                4 => 4,
                                5 => 5,
                                6 => 6,
                                7 => 7,
                                8 => 8,
                                9 => 9,
                                10 => 10,
                                11 => 11,
                                12 => 12,
                            ] ,'star'=>true])

                        </div>

                        <div class="col-md-4">

                            @include('partials.tags',['field_title' => 'انتخاب زبان', 'field_name' => 'lang','multiple' => true,'star' => true ,'options' => config('app.locales') ])

                            @include('partials.select',['field_title' => 'آگهی های ویژه', 'field_name' => 'advertising', 'data' => [
                               'yes' => 'بله',
                               'no' => 'خیر',
                           ] ,'star'=>true])

                            @include('partials.select',['field_title' => 'صندوق پیام اختصاصی', 'field_name' => 'message', 'data' => [
                                'yes' => 'بله',
                                'no' => 'خیر',
                            ] ,'star'=>true])


                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn green btnFromSave"><i class="fa fa-save"></i>ذخیره</button>
                    <button type="button" class="btn red btnFromReset"><i class="fa fa-trash-o"></i>خالی کردن</button>
                    <a href="{{ route('admin.sub_scriptions.index') }}" class="btn default"><i class="fa fa-arrow-left"></i>انصراف</a>
                    @push('style')
                    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet"
                          type="text/css"/>
                    @endpush
                    @push('script')
                    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}"
                            type="text/javascript"></script>
                    <script>
                        $(document).ready(function () {

                            $('#special_page').val('{{ $news->special_page }}');
                            $('#special_page_slider').val('{{ $news->special_page_slider }}');
                            $('#duration_membership').val('{{ $news->duration_membership }}');
                            $('#message').val('{{ $news->message }}');
                            $('#advertising').val('{{ $news->advertising }}');
                            $('#lang').val('{{ $news->lang }}');


                            $('.btnFromSave').click(function () {
                                var $this = $(this).prop('disabled', true);
                                var $form = $('#frm1');
                                $form.find('.has-error').removeClass('has-error');
                                $form.find('.help-block').remove();
//                                CKEDITOR.instances['input_text'].updateElement();
                                $.post('{{ route('admin.sub_scriptions.update') }}', $form.serialize(), function (data) {
                                    if (data.ok) {
                                        window.location.replace('{{ route('admin.sub_scriptions.index') }}');
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
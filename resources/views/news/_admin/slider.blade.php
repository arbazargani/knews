@extends('_layouts.admin')
@section('menu_active', 'news')

@section('title', 'مدیریت اسلایدرها')

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i> <a href="">پیشخوان</a> <i class="fa fa-angle-double-left"></i>
        </li>
        <li>
            <span>لیست اسلایدرها</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">دسترسی
                سریع<i class="fa fa-angle-down"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="{{ route('admin.news.create') }}"> <i class="icon-user"></i> ثبت خبر جدید</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('admin.news.index') }}"> <i class="icon-shield"></i> لیست اسلایدرها من</a>
                </li>

            </ul>
        </div>
    </div>
@endsection

@section('content')
    <h3 class="page-title"> لیست جامع اسلایدرها:
        <small>تمام اسلایدرها</small>
    </h3>

    <div dir="rtl">
        <div id="grid1"></div>
    </div>


    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('custom.change') @lang('auth.password')</h4>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.news.slider.list.put') }}" id="frm1" >
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="cid" id="cid" value="0">
                        {{ csrf_field() }}
                        @include('partials.text',['field_title' => 'تاریخ شروع', 'field_name' => 'start_at', 'star'=>true, 'icon'=>false])

                        @include('partials.text',['field_title' => 'تاریخ پایان' , 'field_name' => 'end_at', 'star'=>true, 'icon'=>false])
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnFromSave">@lang('custom.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('custom.close')</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('style')
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/default/easyui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery-easyui-1.4.4/themes/icon.css') }}">
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.css')  }}">
@endpush

@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/jquery-easyui-1.4.4/jquery.easyui.min.js')  }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/jquery-easyui-rtl/easyui-rtl.js')  }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/plugins/jquery-easyui-1.4.4/extension/datagrid-filter/datagrid-filter.js')  }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/plugins/jquery-easyui-1.4.4/locale/easyui-lang-fa.js')  }}"></script>
<script type="text/javascript" src="{{ asset('js/jalaali.js')  }}"></script>
<link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fa fa-dashboard',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: true,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'لیست اسلایدرها',
            sortOrder: 'asc',
            url: '{{ route('admin.news.slider.list.post') }}',
            columns: [
                [
                    {field: 'company_name', title: 'نام شرکت', width: '40%', halign: 'center', sortable: true},
                    {field: 'brand', title: 'برند', width: '10%', halign: 'center', sortable: true},
                    {field: 'tel', title: 'تلفن', width: '10%', halign: 'center', sortable: true},
                    {
                        field: 'slider_start_at',
                        title: 'تاریخ شروع نمایش',
                        width: '15%',
                        align: 'center',
                        sortable: true,
                        styler: ltrStyler,
                        formatter: function (val) {
                            if (val != null)
                                return convertToJalali(val, 'datetime');
                            else
                                return 'عدم نمایش'
                        }
                    },
                    {
                        field: 'slider_end_at',
                        title: 'تاریخ اتمام نمایش',
                        width: '15%',
                        align: 'center',
                        sortable: true,
                        styler: ltrStyler,
                        formatter: function (val) {
                            if (val != null)
                                return convertToJalali(val, 'datetime');
                            else
                                return 'عدم نمایش'
                        }
                    }
                ]
            ],
            toolbar: [
                {
                    text: 'انتخاب تاریخ نمایش',
                    iconCls: 'fa fa-edit',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row) {
                            $('#cid').val(row.id);
                            $('input[name=start_at]').val('');
                            $('input[name=end_at]').val('');
                            $('.bs-example-modal-lg').modal('toggle');
                        }
                        else {
                            $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                        }
                    }
                }
            ]
        });

        function ltrStyler(value, row, index) {
            return 'direction:ltr;';
        }

        dg.datagrid('enableFilter', [
            {
                field: 'slider_start_at',
                type: 'validatebox',
                options: {precision: 1},
                op: ['less', 'greater']
            },
            {
                field: 'slider_end_at',
                type: 'validatebox',
                options: {precision: 1},
                op: ['less', 'greater']
            }
        ]);
        $('input[name=slider_start_at]')
            .css('direction', 'ltr')
            .addClass('input-group-addon')
            .attr('data-MdDateTimePicker', 'true')
            .attr('data-enabletimepicker', 'true')
            .attr('readonly', 'true')
        ;
        $('input[name=slider_end_at]')
            .css('direction', 'ltr')
            .addClass('input-group-addon')
            .attr('data-MdDateTimePicker', 'true')
            .attr('data-enabletimepicker', 'true')
            .attr('readonly', 'true')
        ;
        $('input[name=start_at]').click(function () {
            $('div[role="tooltip"]').css('z-index','2147483647')
        });
        $('input[name=end_at]').click(function () {
            $('div[role="tooltip"]').css('z-index','2147483647')
        });
        $('input[name=start_at]')
            .css('direction', 'ltr')
            .attr('data-MdDateTimePicker', 'true')
            .attr('data-enabletimepicker', 'true')
            .attr('readonly', 'true')
        ;
        $('input[name=end_at]')
            .css('direction', 'ltr')
            .attr('data-MdDateTimePicker', 'true')
            .attr('data-enabletimepicker', 'true')
            .attr('readonly', 'true')
        ;
        $('.btnFromSave').click(function () {
            var $form = $('#frm1');
            var $this = $(this).prop('disabled', true);
            var url = $form.attr('action') ;
            $.post(url, $form.serialize(), function (data) {
                if (data.ok) {
                    toastr.success(data.msg);
                    $this.prop('disabled', false);
                    dg.datagrid('reload');
                    $('.bs-example-modal-lg').modal('toggle');
                } else {
                    toastr.error(data.msg);
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

    });
</script>
<script type="text/javascript" src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/calendar.js') }}"></script>
<link rel="stylesheet" type="text/css"
      href="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css')  }}">
<script type="text/javascript"
        src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>

@endpush
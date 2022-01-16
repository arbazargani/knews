@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.add_product') )

@section('profile_content')
	<div class="account-account">

        <div id="content" class="col-sm-9">
            <div class="form-group">
                <article class="article-info">
                    <div class="article-title">
                        <h1>@lang('custom.add_product')</h1>
                    </div>

                    <form action="{{ route('profile.products.create.post') }}" id="frm1" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset id="account">
                            <legend>@lang('custom.add_product_desc')</legend>

                            <div class="row">

                                <label class="col-sm-2 control-label" for="input_title"><span class="text-danger">*</span> @lang('custom.categories'):</label>
                                <div class="col-sm-4">
                                    <button style="margin-top:0px" type="button" class="btn btn-blue btn-sm pull-right select_cat" data-toggle="modal" data-target="#modalCategorySelect" autocomplete="off">
                                    @lang('custom.select_category')
                                    </button>
                                    <input type="hidden" name="select_cat" id="select_cat" value="">
                                </div>

                                @include('partials.select_small',['field_title' => trans('custom.brand') , 'field_name' => 'brand', 'data' => $companies ,'star'=>true])
                            </div>

                            <div class="row">
                                @include('partials.text_small' , ['field_title' => trans('custom.product_name') , 'field_name' => 'product_name','star'=>true])

                                @include('partials.text_small' , ['field_title' => trans('custom.product_model') , 'field_name' => 'product_model','star'=>true])
                            </div>

                            <div class="row">
                                <label class="col-sm-2 control-label" for="input_title"><span class="text-danger">*</span> @lang('custom.product_images'):</label>
                                <div class="col-sm-10">
                                    @include('partials.attachment',['field_title' => '', 'field_name' => 'file_url', 'file_types' => 'jpg', 'type' => 'image' ])
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                @include('partials.text_small' , ['field_title' => trans('custom.minimum_order') , 'field_name' => 'minimum_order','star'=>true])

                                @include('partials.select_small',['field_title' => trans('custom.amount') , 'field_name' => 'minimum_order_unit', 'data' => trans('custom.amount_val') ,'star'=>true])
                            </div>

                            <div class="row">
                                <label class="col-sm-2 control-label" for="input_title"><span class="text-danger">*</span> @lang('custom.supply_ability'):</label>
                                <div class="col-sm-4">
                                    {!! Form::text('supply_ability', '' ,['class' => 'form-control','placeholder' => trans('custom.supply_ability') ,'id' => 'supply_ability' ]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select( 'supply_ability_unit' , trans('custom.amount_val') , null , ['class' => 'form-control' , 'id'=>'supply_ability_unit']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select( 'supply_ability_per' , trans('custom.supply_ability_per_val') , null , ['class' => 'form-control' , 'id'=>'supply_ability_per']) !!}
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 control-label" for="input_title"><span class="text-danger">*</span> @lang('custom.prices'):</label>
                                <div class="col-sm-4">
                                    {!! Form::text('prices', '' ,['class' => 'form-control','placeholder' => trans('custom.prices') ,'id' => 'prices' ]) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select( 'prices_currency' , trans('custom.prices_currency_val') , null , ['class' => 'form-control' , 'id'=>'prices_currency']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select( 'prices_unit' , trans('custom.amount_val') , null , ['class' => 'form-control' , 'id'=>'prices_unit']) !!}
                                </div>
                            </div>

                            <div class="row">
                                @include('partials.text_small' , ['field_title' => trans('custom.delivery_time') , 'field_name' => 'delivery_time','star'=>true])
                            </div>

                            <hr/>

                            <div class="row">
                                @include('partials.select_small',['field_title' => trans('custom.delivery_terms') , 'field_name' => 'delivery_terms', 'data' => trans('custom.delivery_terms_val') ,'star'=>true ,'multiple'=>true])

                                @include('partials.select_small',['field_title' => trans('custom.payments_terms') , 'field_name' => 'payments_terms', 'data' => trans('custom.payments_terms_val') ,'star'=>true ,'multiple'=>true])
                            </div>

                            <div class="row">

                                <label class="col-sm-2 control-label" for="input_title"><span class="text-danger">*</span> @lang('custom.product_keyword'):</label>
                                <div class="col-sm-10">
                                    <select name="product_keyword[]" id="product_keyword" class="form-control"  multiple="multiple">
                                    </select>
                                </div>

                            </div>
                            <hr/>

                            <div class="row">
                                <label class="control-label" for="input_text"><span class="text-danger">*</span> @lang('custom.packing_details'):</label>
                                <textarea class="ckeditor form-control" name="packing_details" id="packing_details" rows="6"></textarea>
                            </div>
                            <hr/>
                            <div class="row">
                                <label class="control-label" for="input_text"><span class="text-danger">*</span> @lang('custom.description_detailed'):</label>
                                <textarea class="ckeditor form-control" name="description_detailed" id="description_detailed" rows="6"></textarea>
                            </div>
                            <hr/>

                            <div class="row">
                                @include('partials.select_small',['field_title' => trans('custom.select_language') , 'field_name' => 'lang', 'data' =>  config('app.locales')  ,'star'=>true])

                                {{--@include('partials.text_small' , ['field_title' => trans('custom.expiration_date') , 'field_name' => 'expiration_date','star'=>true])--}}

                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                @lang('custom.rule_add_product',['link'=>route('home')])
                                    <input type="checkbox" name="agree" value="1" id="agree"><label for="agree"></label><label for="agree"></label>&nbsp;
                                <input type="submit" value="@lang('custom.product_registration')" class="btn btn-primary btnFromSave">
                            </div>
                        </div>
                    </form>
                </article>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalCategorySelect" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">@lang('custom.select_category')</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <label class="col-md-3 control-label" for="product-company">
                                    <span class="text-danger">*</span>@lang('custom.category') :
                                </label>
                                <div class="col-md-8">
                                    {!! Form::select( 'category_parent' , $product_cats , null , ['class' => 'form-control' , 'id'=>'category_parent']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <div class="row">
                            <div id="div_sub_parent" style="display: none;margin-top: 10px"><label style="text-align: right;" class="col-md-3 control-label" for="product-company">
                                <span class="text-danger">*</span>@lang('custom.category')</label> <div class="col-md-8">
                                    {!! Form::select( 'category_sub_parent' , [] , null , ['class' => 'form-control', 'id'=>'category_sub_parent']) !!}
                                </div>
                            </div>
                            </div>

                            <div class="row">
                            <div id="div_sub_parent_2" style="display: none;margin-top: 10px">
                                <label style="text-align: right;" class="col-md-3 control-label" for="product-company">
                                <span class="text-danger">*</span>@lang('custom.category')</label> <div class="col-md-8">
                                    {!! Form::select( 'category_sub_parent_2' , ['a','aaa','aaa'] , null , ['class' => 'form-control', 'id'=>'category_sub_parent_2']) !!}
                                </div>
                            </div>
                            </div>

                        </div>

                        <div class="row" style="direction: ltr; margin-left: 11px; margin-bottom: 10px;">
                            <button type="button" class="btn btn-primary btnApprove">@lang('custom.approve')</button>
                            <img src="{{ url('images/ajax_loading.gif') }}" alt="loading" style="display: none;" class="loading">
                        </div>
                    </div>
                </div>
            </div>

        </div>

	</div>

@endsection

@push('style')
<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
{{--@if( trans('custom.lang.'.App::getLocale().'.dir') == 'rtl')
    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
@endif--}}
    <style>
        #modalCategorySelect .select2.select2-container{
            width: 100% !important;
        }
        #content form div.row{
            margin-bottom: 12px;
        }
        .modal-footer{
            border-top: 0px;
            text-align: @lang('custom.lang.'.App::getLocale().'.direcrion') !important;
        }
        .select2-container .select2-search--inline{
            float: right;
        }
        input.select2-search__field {
            width: 100% !important;
        }

    </style>
@endpush

    @push('script_bottom')
    <script src="{{ asset('assets/plugins/select2_4.0.0/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2_4.0.0/js/i18n/'.App::getLocale().'.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor-4.4.5/ckeditor.js') }}"></script>
{{--    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>--}}

    <script>

        CKEDITOR.replace('packing_details', {
            customConfig: '{{ asset('assets/plugins/ckeditor-4.4.5/config_min.js') }}',
            language: '{{ config('app.locale') }}'
        });
        CKEDITOR.replace('description_detailed', {
            customConfig: '{{ asset('assets/plugins/ckeditor-4.4.5/config_min.js') }}',
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

        $(document).ready(function () {
            var flag_cat = false;
            $('#content select').select2();
            $('#content #product_keyword').select2({tags: true});

            $('.btnApprove').click(function () {
                if(flag_cat){
                    a = $('#category_parent').select2('data');
                    b = $('#category_sub_parent').select2('data');
                    c = $('#category_sub_parent_2').select2('data');
                    $('.select_cat').text( a[0].text + ' / ' + b[0].text + ' / ' + c[0].text );
                    $('#select_cat').val( $('#category_sub_parent_2').val() );
                    $('#modalCategorySelect').modal('toggle');

                }
                else {
                    alert('@lang('custom.select_category')');
                }
            });

            $('#category_sub_parent').on("change", function () {
                $('.loading').show();
                url = '{{ route('profile.products.cat.list') }}' ;
                $.post(url, { 'cat_id': $('#category_sub_parent').val() , cat_lvl : 2 } ,function (data) {
                    if (data.ok) {
                        $('#category_sub_parent_2').empty();
                        $.each(data.data,function (key, val) {
                            $('#category_sub_parent_2').append($('<option></option>').attr('value', key).text(val));
                        });
                        $('#category_sub_parent_2').select2();
                        $('#div_sub_parent_2').show();
                        $('.loading').hide();
                        flag_cat = true;
                    } else {
                        alert('@lang('custom.select_category')');
                    }
                }, 'json').fail(function (jqXhr) {
                    if (jqXhr.status === 401)
                        window.location.replace('{{ route('login') }}');
                    else if (jqXhr.status === 422) {
                        $.each(jqXhr.responseJSON, function (key, value) {
                            alert(value);
                        });
                    }
                });
            });

            $('#category_parent').on("change", function () {
                $('.loading').show();
                url = '{{ route('profile.products.cat.list') }}' ;
                $.post(url, { 'cat_id': $('#category_parent').val() , cat_lvl : 1 } ,function (data) {
                    if (data.ok) {
                        $('#category_sub_parent').empty();
                        $.each(data.data,function (key, val) {
                            $('#category_sub_parent').append($('<option></option>').attr('value', key).text(val));
                        });
                        $('#category_sub_parent').select2();
                        $('#div_sub_parent').show();
                        $('.loading').hide();
                    } else {
                        alert('@lang('custom.select_category')');
                    }
                }, 'json').fail(function (jqXhr) {
                    if (jqXhr.status === 401)
                        window.location.replace('{{ route('login') }}');
                    else if (jqXhr.status === 422) {
                        $.each(jqXhr.responseJSON, function (key, value) {
                            alert(value);
                        });
                    }
                });
            });

            $('.btnFromSave').click(function () {
                var $imgs = imgjson('.msg');
                if($imgs == '{}')
                    $imgs = '';
                $('input[name=file_url]').val($imgs);
                var $this = $(this).prop('disabled', true);
                var $form = $('#frm1');
                CKEDITOR.instances['packing_details'].updateElement();
                CKEDITOR.instances['description_detailed'].updateElement();
                $.post($form.attr('action'), $form.serialize(), function (data) {
                    if (data.ok) {
                        toastr.success('@lang('custom.success_save')');
                        window.location.replace(data.link);
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
                    return false;
                });
                return false;
            });


        });

        function imgjson( ndiv ){
            jsonss = '{' ;
            $(ndiv).find('img').each(function(index, item){
                jsonss += '"'+ index +'":"'+ $(this).attr('snattr') +'",' ;
            });
            jsonss = jsonss + '}';
            jsonss = jsonss.replace(/,}/gi, "}");
            return jsonss ;
        }



    </script>

@endpush
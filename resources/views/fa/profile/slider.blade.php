@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.company_information') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">
                <div id="content" class="col-sm-12"><h1> @lang('custom.send') @lang('custom.slider')</h1>
                    <form action="{{ route('profile.company.slider.store') }}" id="frm1" method="post"
                          enctype="multipart/form-data" class="form-horizontal">
                        <div class="row">
                            @include('partials.select_small',
                            ['field_title' => trans('custom.company_name') ,
                             'field_name' => 'company_name',
                              'data' => $comp ,
                              'star'=>true
                              ])
                        </div>
                        <div class="row">
                            <label class="col-sm-2 control-label" for="input_title"><span
                                        class="text-danger">*</span> @lang('custom.product_images'):</label>
                            <div class="col-sm-10">
                                @include('partials.attachment',['field_title' => '', 'field_name' => 'file_url', 'file_types' => 'jpg', 'type' => 'image' ])
                            </div>
                        </div>
                        <div class="buttons">
                            <div class="pull-right">
                                <input type="submit" value="@lang('custom.send') @lang('custom.slider')"
                                       class="btn btn-primary btnFromSave"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_bottom')
<script>
    $(document).ready(function () {

        $('#company_name').change(function () {
            if($('#company_name').val() == 0 )
                return false ;
            $('.msg').html('');
            var _param = {
                '_method': 'PUT',
                'cid': $('#company_name').val()
            };
            var _url = '{{ route('profile.company.slider.put') }}';
            $.post(_url, _param, function (data) {
                if (data.ok) {
                    if(data.data.slider == '')
                        return false;
                    var obj = jQuery.parseJSON(data.data.slider);
                    $.each(obj ,function (key,val) {
                        $('.msg').append('<li class="li-up"><img style="height: 120px; width: 165px;" snattr="'+val+'" src="{{ url('files') }}/'+ val +'" /> <br/> <a id="li_up_a" style="cursor: pointer;">حذف</a> </li>');
                    });
                }
            }, 'json').fail(function (jqXhr) {
                if (jqXhr.status === 401) //redirect if not authenticated user.
                    window.location.replace('{{ route('login') }}');
                else if (jqXhr.status === 422) {
                    $.each(jqXhr.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                    $this.prop('disabled', false);
                }
                return false;
            });
        });

        $('.btnFromSave').click(function () {
            var $imgs = imgjson('.msg');
            if ($imgs == '{}')
                $imgs = '';
            $('input[name=file_url]').val($imgs);
            var $this = $(this).prop('disabled', true);
            var $form = $('#frm1');

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

    function imgjson(ndiv) {
        jsonss = '{';
        $(ndiv).find('img').each(function (index, item) {
            jsonss += '"' + index + '":"' + $(this).attr('snattr') + '",';
        });
        jsonss = jsonss + '}';
        jsonss = jsonss.replace(/,}/gi, "}");
        return jsonss;
    }

</script>
@endpush
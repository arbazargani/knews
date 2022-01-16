@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.profile') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">
                <div class="col-sm-4">
                    <h3><i class="fa fa-user"></i>@lang('custom.profile')</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('profile.personal') }}">@lang('custom.edit') @lang('auth.person_information')</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal"
                               data-target=".bs-example-modal-lg">@lang('custom.change') @lang('auth.password') </a>
                        </li>
                        {{--<li>
                            <a href="{{ route('profile.company.list') }}">@lang('custom.company_list_mine')</a>
                        </li>--}}
                    </ul>
                </div>
                {{--<div class="col-sm-4">
                    <h3><i class="fa fa-shopping-cart"></i>@lang('custom.orders')</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('products.order.list') }}">@lang('custom.your_order')</a>
                        </li>
                        <li>
                            <a href="{{ route('products.sale.list') }}">@lang('custom.your_sale')</a>
                        </li>
                    </ul>
                </div>--}}
                {{--<div class="col-sm-4">
                    <h3><i class="fa fa-envelope"></i>خبر نامه</h3>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('newsletter') }}">@lang('custom.newsletter',['type'=> ( Auth::user()->newsletter == 'yes' )? trans('custom.unsubscriptions') : trans('custom.subscriptions') ])</a>
                        </li>
                    </ul>
                </div>--}}
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('custom.change') @lang('auth.password')</h4>
                </div>
                <div class="modal-body">

                    <form action="{{ route('profile.change.pass') }}" id="frm1">
                        {{ csrf_field() }}
                        @include('partials.password',['field_title' => trans('auth.password'), 'field_name' => 'pass', 'star'=>true, 'icon'=>false])

                        @include('partials.password',['field_title' => trans('auth.repeat') .' '. trans('auth.password'), 'field_name' => 'confirm', 'star'=>true, 'icon'=>false])
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnFromSave">@lang('custom.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('custom.close')</button>
                </div>
            </div>
        </div>
    </div>
    @push('style')
    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
    @push('script_bottom')
    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('input[name=pass]').addClass('form-control');
            $('input[name=confirm]').addClass('form-control');
            $('.btnFromSave').click(function () {
                var $this = $(this).prop('disabled', true);
                var $form = $('#frm1');
                url = $form.attr('action');
                $.post(url, $form.serialize(), function (data) {
                    if (data.ok) {
                        $form.find('input').val('');
                        toastr.success(data.msg[0]);
                        $this.prop('disabled', false);
                        $('.bs-example-modal-lg').modal('toggle');
                    } else {
                        $this.prop('disabled', false);
                    }
                }, 'json').fail(function (jqXhr) {
                    if (jqXhr.status === 401) //redirect if not authenticated user.
                        window.location.replace('{{ route('login') }}');
                    else if (jqXhr.status === 422) {
                        $.each(JSON.parse(jqXhr.responseText), function (key, value) {
                            toastr.error(value[0]);
                        });
                        $this.prop('disabled', false);
                    } else
                        $this.prop('disabled', false);
                });
            });

            $('.btnFromReset').click(function () {
                $('#frm1')[0].reset();
                //CKEDITOR.instances['input_text'].setData('');
            });
        });
    </script>
    @endpush


@endsection



@inject('comments', 'App\Libraries\UserComments')

<form class="form-horizontal" id="form-review" action="{{ route('comments.store') }}" method="post" >
    <input type="hidden" value="{{$post_id}}" id="post_id" name="post_id">
    <input type="hidden" value="{{$module}}" id="module" name="module">
    <div id="review">
        <div class="review-item">
            @foreach($comments->fetch( $post_id ) as $val)
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        {{--<div class="review-score">
                            <span class="fa-stack">
                              <i class="material-design-mark1 fa-stack-1x"></i>
                              <i class="material-design-mark1 star fa-stack-1x"></i>
                            </span>
                            <span class="fa-stack">
                              <i class="material-design-mark1 fa-stack-1x"></i>
                              <i class="material-design-mark1 star fa-stack-1x"></i>
                            </span>
                            <span class="fa-stack">
                              <i class="material-design-mark1 fa-stack-1x"></i>
                              <i class="material-design-mark1 star fa-stack-1x"></i>
                            </span>
                            <span class="fa-stack">
                              <i class="material-design-mark1 fa-stack-1x"></i>
                              <i class="material-design-mark1 star fa-stack-1x"></i>
                            </span>
                            <span class="fa-stack">
                              <i class="material-design-mark1 fa-stack-1x"></i>
                              <i class="material-design-mark1 star fa-stack-1x"></i>
                            </span>
                        </div>--}}
                        <div class="review-author"><strong>{{ $val->name }}</strong></div>
                        <div class="review-date">
                            {{ jDateTime::strftime('d F Y - H:i', strtotime($val->created_at)) }}
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9">
                        {!! $val->descr !!}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-right"></div>
    </div>

    <div class="product-review-form" id="reviews_form" style="display: block;">
        <div class="review-form-title">
            <h4 class="product-section_title close-tab" id="reviews_form_title">@lang('custom.send_your_comment')</h4>
        </div>
        <div class="form-group required">
            <div class="col-sm-12">
                <label class="control-label" for="input-name">@lang('auth.name')</label>
                <input type="text" name="name" value="" id="input-name" class="form-control">
            </div>
        </div>
        <div class="form-group required">
            <div class="col-sm-12">
                <label class="control-label" for="input-review">@lang('custom.your_comment')</label>
                <textarea name="text" rows="5" id="input-review" class=""></textarea>
            </div>
        </div>
        <div class="form-group{{ $errors->has('txtcaptcha') ? ' has-error' : '' }}" id="captchaBox">
            <label class="control-label visible-ie8 visible-ie9">@lang('custom.captcha_code')</label>
            <div class="input-icon" style="position: relative">
                <input required style="float: right; width: 180px; height: 37px;" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="@lang('custom.captcha_code')" name="txtcaptcha" />
                {!! captcha_img() !!}
                <a href="javascript:void(0)" style="position:absolute;right: 228px;top:-15px;font:10px/10px tahoma;" id="newc">[@lang('custom.captcha_code_new')]</a>
            </div>
        </div>
        <div class="buttons clearfix">
            <div class="pull-right">
                <button type="button" id="button-review"
                        data-loading-text="@lang('custom.loading')"
                        class="btn btn-primary btnFromSave">
                    @lang('custom.send')
                </button>
            </div>
        </div>
    </div>
</form>
@if( trans('custom.lang.'.App::getLocale().'.dir') == 'rtl')
    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />
@endif
@push('script_bottom')
<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.btnFromSave').click(function () {
            var $this = $(this).prop('disabled', true);
            var $form = $('#form-review');
            $.post($form.attr('action'), $form.serialize(), function (data) {
                if (data.ok) {
                    toastr.success('@lang('custom.success_save')');
                    $form.find('input').prop('disabled', true);
                    $form.find('textarea').prop('disabled', true);
                    $('.btnFromSave').prop('disabled', true);
                    $('#reviews_form').slideUp();
                } else {
                    $this.prop('disabled', false);
                }
            }, 'json').fail(function (jqXhr) {
                $("#captchaBox a").click();
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

    $("#captchaBox a").click(function () {
        var someimage = document.getElementById("captchaBox");
        var myimg = someimage.getElementsByTagName('img')[0];
        myimg.src = "{{ url('captcha/default?') }}" + parseInt(Math.random() * 10000);
    });
</script>
@endpush
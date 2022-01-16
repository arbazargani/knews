@extends( App::getLocale().'.template')

@section('title', trans('auth.title') )

@section('content')
    <section class="content-top">
        <div class="container">
            <div class="row">

                @include(App::getLocale().'.cat')

                <div id="content" class="col-sm-9"> <div class="row">
                        <div class="col-sm-6">
                            <div class="well">
                                <h2>@lang('auth.do_reg')</h2>
                                <p><strong>@lang('auth.reg_do')</strong></p>
                                <p>متنی جهت ترغیب کاربر به ثبت نام در سایت. مثلا با ثبت نام در سایت میتوانید خیلی آسان به خرید و فروش محصولات خود بپردازید.</p>
                                <a href="{{ route('register') }}" class="btn btn-primary">@lang('custom.continue')&nbsp;»</a></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="well">
                                <h2>@lang('auth.enter_user')</h2>
                                <p><strong>@lang('auth.befor_reg')</strong></p>
                                <form class="login-form" action="{{ route('login.post') }}" method="post" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="control-label" for="input-email">@lang('auth.email_addr')</label>
                                        <input required  oninvalid="this.setCustomValidity('@lang('custom.required')')" oninput="setCustomValidity('')"   type="text" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="example@gmail.com" id="input-email" class="form-control placeholder-no-fix">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="control-label" for="input-password">@lang('auth.password')</label>
                                        <input required  oninvalid="this.setCustomValidity('@lang('custom.required')')" oninput="setCustomValidity('')"  type="password" name="password" value="" autocomplete="off" placeholder="Password" id="input-password" class="form-control placeholder-no-fix">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        <a href="#">@lang('auth.recover_password')</a>
                                    </div>

                                    <div class="form-group{{ $errors->has('txtcaptcha') ? ' has-error' : '' }}" id="captchaBox">
                                        <label class="control-label visible-ie8 visible-ie9">کد امنیتی</label>
                                        <div class="input-icon">
                                            <input required  oninvalid="this.setCustomValidity('@lang('custom.required')')" oninput="setCustomValidity('')"   style="float: right; width: 180px; height: 37px;" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="کد امنیتی" name="txtcaptcha" />
                                            {!! captcha_img() !!}
                                            <a href="javascript:void(0)" style="font: 10px/10px tahoma; margin: 0px; position: relative; top: -60px; left: -25px;" id="newc">[کد امنیتی جدید]</a>
                                        </div>
                                    </div>
                                    @push('script_bottom')
                                    <script type="text/javascript">
                                        $("#captchaBox a").click(function () {
                                            var someimage = document.getElementById("captchaBox");
                                            var myimg = someimage.getElementsByTagName('img')[0];
                                            myimg.src = "{{ url('captcha/default?') }}" + parseInt(Math.random() * 10000);
                                        });</script>
                                    @endpush

                                    <input type="submit" value="@lang('auth.enter_user')" class="btn btn-primary">
                                    <input type="hidden" name="redirect" value="#">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection


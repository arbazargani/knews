<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} - Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="{{ asset('assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/plugins/bootstrap_3.3.6/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/components-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/plugins-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/_admin-4.5.4/css/login-4-rtl.min.css') }}" rel="stylesheet" type="text/css"/>
    <meta content="SaMa" name="author" />

    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">
</head>
<body class=" login">
<div class="logo">
    <a href="{{ route('home') }}">
        <img src="{{/* url('images/logo-hor.png')*/ image_url('logo-wide.png',250,150,false) }}" alt="{{ config('app.name') }}" style="width: 200px" /> </a>
</div>
<div class="content">

    <form class="login-form" action="{{ route('login.post') }}" method="post">
        {!! csrf_field() !!}
        <h3 class="form-title">درگاه ورودی</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>نام کاربری و کلمه عبور الزامی می باشد. </span>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input value="{{ old('email') }}" class="form-control placeholder-no-fix" style="direction: ltr" type="text" autocomplete="off" placeholder="Username" name="email" />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" style="direction: ltr" type="password" autocomplete="off" placeholder="Password" name="password" />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <br/>

        <div class="form-group{{ $errors->has('txtcaptcha') ? ' has-error' : '' }}" id="captchaBox">
            <label class="control-label visible-ie8 visible-ie9">کد امنیتی</label>
            <div class="input-icon">
                <i class="fa fa-unlock"></i>
                <input required style="float: right; width: 180px; height: 37px;" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="کد امنیتی" name="txtcaptcha" />
                {!! captcha_img() !!}
                <a href="javascript:void(0)" style="position:absolute; left:0px; top:-15px; font:10px/10px tahoma;" id="newc">[کد امنیتی جدید]</a>
            </div>
        </div>



        <div class="form-actions">
            <div class="checkbox" style="margin-right: 20px">
                <label>
                    <input type="checkbox" name="remember">
                    مرا به خاطر بسپار
                </label>
            </div>
            <button type="submit" class="btn green pull-right"> ورود به درگاه </button>
            <br/>
        </div>
    </form>
</div>
<div class="copyright">
    <a href="#">

    </a>
</div>
<!--[if lt IE 9]>
<script src="{{ asset('assets/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/plugins/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap_3.3.6/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/_admin-4.5.4/scripts/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/_admin-4.5.4/scripts/login-4.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $("#captchaBox a").click(function () {
        var someimage = document.getElementById("captchaBox");
        var myimg = someimage.getElementsByTagName('img')[0];
        myimg.src = "{{ url('captcha/default?') }}" + parseInt(Math.random() * 10000);
    });</script>
</body>

</html>
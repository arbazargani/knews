<!--DOCTYPE html-->
<html dir="rtl">
<head lang="fa">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords"  content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - Login</title>
    <link href="{{ url('assets/login/metro.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/login/metro-icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/login/metro-responsive.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/login/metro-schemes.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css') }}" rel='stylesheet'
          type='text/css'>
    <link href="{{ asset('assets/plugins/bootstrap_3.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="http://scriptunited.com/demo/metroskin/laravel/public/metro/images/logo2.png"> -->
    <link href="{{ url('assets/login/docs.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/login/docs-rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">
    <script src="{{ url('assets/login/jquery-2.1.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/metro.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/parsley.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/jquery.form.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/moment.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/persian-date.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/docs.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/login/jquery.backstretch.min.js') }}" type="text/javascript"></script>
</head>
<body onload="init();" class=" " dir="">
<div id="user-body">
    <div class="login-form padding20 fg-white ">
        <form action="{{ route('login.post') }}" method="post">
            {!! csrf_field() !!}
            <h1 class="text-light text-shadow">درگاه ورودی</h1>
            <hr class="bg-white"/>
            <br/>
            <div class="input-control text full-size{{ $errors->has('email') ? ' has-error' : '' }}" data-role="input">
                <label for="email">نام کاربری:</label>
                <input required oninvalid="this.setCustomValidity('@lang('custom.required')')"
                       oninput="setCustomValidity('')" value="{{ old('email') }}"
                       class="form-control placeholder-no-fix" style="direction: ltr" type="text" autocomplete="off"
                       placeholder="Username" name="email"/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="input-control password full-size{{ $errors->has('password') ? ' has-error' : '' }}"
                 data-role="input">
                <label for="password">کلمه عبور:</label>
                <input required oninvalid="this.setCustomValidity('@lang('custom.required')')"
                       oninput="setCustomValidity('')" class="form-control placeholder-no-fix" style="direction: ltr"
                       type="password" autocomplete="off" placeholder="Password" name="password"/>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="input-control password full-size{{ $errors->has('txtcaptcha') ? ' has-error' : '' }}"
                 id="captchaBox">
                <label class="control-label visible-ie8 visible-ie9">کد امنیتی</label>
                <div class="input-icon">

                    <input oninvalid="this.setCustomValidity('@lang('custom.required')')"
                           oninput="setCustomValidity('')" required style="float: right; width: 180px; height: 37px;"
                           class="form-control placeholder-no-fix" type="text" autocomplete="off"
                           placeholder="کد امنیتی" name="txtcaptcha"/>
                    {!! captcha_img() !!}
                    <a href="javascript:void(0)" style="position:absolute; left:0px; top:-15px; font:10px/10px tahoma;"
                       id="newc">[کد امنیتی جدید]</a>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="button primary"> ورود به درگاه</button>
            </div>
            {{--<div>
                <p>Don't have any account?</p>
                <a href='http://scriptunited.com/demo/metroskin/laravel/user/form/signup2' class="fg-white" type="fg-white "><span class="fa fa-sign-in"></span> <u>Register here</u></a>
            </div>--}}
        </form>
    </div>
    <div id="minicalendar">
        <h1 id="date"> {{  \jDate::forge()->format('%A ، %d %B ') }} </h1>
        <h1 id="clock"> {{  \jDate::forge()->format('H:i') }} </h1>
    </div>
    <style>
        #minicalendar {
            position: fixed;
            bottom: 3rem;
            left: 2rem;
            color: #fff;
        }
        #clock {
            font-size: 90px;
            position: relative;
            top: -1rem;
        }
        .login-form {
            width: 18rem;
            height: auto;
            position: fixed;
            top: 0;
            bottom: 0px;
            right: -18rem;
            margin-left: -12.5rem;
            background-color: rgba(0, 0, 0, 0.45);
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
        body {
            background-image: url('{{ url('login-images') }}/76cca384092acca2aba152eb630835b306696f617bfb073bfe772827878ba598.jpg');
            background-color: #1d1d1d;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <script type="text/javascript">
        $("#captchaBox a").click(function () {
            var someimage = document.getElementById("captchaBox");
            var myimg = someimage.getElementsByTagName('img')[0];
            myimg.src = "{{ url('captcha/default?') }}" + parseInt(Math.random() * 10000);
        });
        jQuery(document).ready(function ($) {
            var form = $(".login-form");
            form.css({
                opacity: 1,
                right: 0,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": "1s",
                "transition": "1s"
            });
            var img_array = [
                    '{{ url('login-images') }}/02f3a5ec4bce7076943714353c74a42e0b090103db1dc5a768aabddaf1e07534.jpg',
                    '{{ url('login-images') }}/24abca5d4dcb8c81b45ca4c96c74a155384adb448a4f2803d92339fe8e030ab6.jpg',
                    '{{ url('login-images') }}/2d86bf9453947f62aff6e8803c2340ef8c73580601fabf9fe8ba7f2cab2b8817.jpg',
                    '{{ url('login-images') }}/3bce8d813a8004fee3e693befcfdf1cbb6e363eef57b70388357125dd9552ac1.jpg',
                    '{{ url('login-images') }}/47719e995553ba974dceefe6c4cc6c11abf62a6e9ebac8504b268ff3dd446add.jpg',
                    '{{ url('login-images') }}/4a47f922729aa383451167a7d9cdb8fc7d038a62ced02163fdee3970df34c0ed.jpg',
                    '{{ url('login-images') }}/519428bcf90c5356bc7d6febcf5e248829bcc9affd70f2f22bcba75ad64e77ff.jpg',
                    '{{ url('login-images') }}/5f8e9756d4605e434dea465ff0bccf6b70e50c9ad4fedaea0d7b51c66adc0bd0.jpg',
                    '{{ url('login-images') }}/6aa0da31e965aae46e3c3de4d2c5b30efd8d83498c46c9701aeedb431057c323.jpg',
                    '{{ url('login-images') }}/76cca384092acca2aba152eb630835b306696f617bfb073bfe772827878ba598.jpg',
                    '{{ url('login-images') }}/86a053d7e8fd3c8efeb13ddf1057cc3a31cad70b6724793854ddbc9b8bea0c6a.jpg',
                    '{{ url('login-images') }}/8d71495e43fa1c6887a8840aa45ba74a29a2ff6c7493d8e4c8594a937700a12e.jpg',
                    '{{ url('login-images') }}/8f7bb8973571a2de584685c9b6dc65b9e51d070d7fdad42ae2abd62d3be76c5e.jpg',
                    '{{ url('login-images') }}/9bd0b59b87ae036fd1be29d98e42fc87ee9b096f97f4a002b766a85b3b596450.jpg',
                    '{{ url('login-images') }}/9d3d5f4b786f804a35fcaf6dfec8e4799d677372ac75ca12a208a04136a16cd2.jpg',
                    '{{ url('login-images') }}/c09666d6d7c2f3d716261ceedab1ef26035771a132f929861c8616c38ee8f8b0.jpg',
                    '{{ url('login-images') }}/c4747aba2b1d08a4ae6c6db06fe5eac74511fbe421e7243eaa5e480db03bf5d9.jpg'
                ]
                    /*,
                     newIndex = 0,
                     index    = 0,
                     interval = 15000*/;

            $.backstretch(img_array, {duration: 5000, fade: 2500});

            function clock() {
                $('#clock').html(moment().format('H:mm'));
//                $('#date').html(moment().format('dddd<br>D MMMM'));
            }
            setInterval(clock, 1000);
        });

    </script>


</div>

<script type='text/javascript'>
    jQuery(document).ready(function ($) {
        $.Notify({
            content: '',
            type: '',
            shadow: true
        })
    })
</script>

</body>
</html>
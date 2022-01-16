@extends( App::getLocale().'.template')

@section('content')
    <div style="clear:both;/*padding-top:80px;*/"></div>
    <section class="content-top" style="margin: 60px 0px;">
        <div class="container">
            <div class="row">

                @include(App::getLocale().'.profile.profile_menu')

                @yield('profile_content')

            </div>
        </div>
    </section>

@endsection


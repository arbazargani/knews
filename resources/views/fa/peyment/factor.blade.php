@extends(App::getLocale().'.profile.main')

@section('title', trans('custom.factor') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-sm-12"> <h1>@lang('custom.factor')</h1>

                    <div dir="@lang('custom.lang.'.App::getLocale().'.dir')">
                        <div class="col-md-12">
                            <div class="row">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('custom.title')</th>
                                        <th>@lang('custom.prices')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->price }} @lang('custom.rial') </td>
                                    </tr>
                                    <tr style="font-weight:bold ">
                                        <td colspan="2" style="text-align: center">@lang('custom.total')</td>
                                        <td>{{ $course->price }} @lang('custom.rial') </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-warning" type="button" name="en">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                @lang('custom.payment')
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    @push('script_bottom')
                    <script type="text/javascript" src="{{ asset('js/jalaali.js')  }}"></script>
                    <script>
                        $(function () {
                            //return convertToJalali(val, 'datetime');
                        });
                    </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>
@endsection
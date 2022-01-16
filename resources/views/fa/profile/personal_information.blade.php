@extends(App::getLocale().'.profile.main')

@section('title', trans('auth.person_information') )

@section('profile_content')
    <div class="account-account">
        <div id="content" class="col-sm-9">
            <div class="row">

                <div id="content" class="col-sm-12"> <h1>@lang('auth.person_information')</h1>
                    <form action="{{ route('profile.personal') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ csrf_field() }}
                        <fieldset id="account">
                            <div class="form-group required {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label" for="input-firstname">@lang('auth.name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="firstname" value="{{ Auth::user()->name }}" placeholder="@lang('auth.name')" id="input-firstname" class="form-control">
                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label" for="input-lastname">@lang('auth.family')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lastname" value="{{ Auth::user()->family }}" placeholder="@lang('auth.family')" id="input-lastname" class="form-control">
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label" for="input-mobile">@lang('auth.mobile')</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="mobile" value="{{ Auth::user()->mobile }}" placeholder="@lang('auth.mobile')" id="input-mobile" class="form-control">
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('file_url') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label" for="input-mobile">@lang('custom.edit_pic')</label>
                                <div class="col-sm-10">

                                    @include('partials.attachment',['field_title' => '', 'field_name' => 'file_url', 'file_types' => 'jpg' , 'data'=> Auth::user()->avatar ])

                                </div>
                            </div>




                        </fieldset>
                        <div class=" buttons">
                            <input type="submit" value="@lang('custom.save')" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
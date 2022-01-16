@extends( App::getLocale().'.template')

@section('title', trans('custom.contactus') )

@section('content')


    <div class="sliderInformation" style="padding-right: 20px; border-right: 3px solid #f18c19; margin-top: 16px; ">
        <p class="sliderTitle">
            <a target="_blank"> تماس با ما </a>
        </p>
    </div>

    <div id="" class=" col-xs-12">
        <div id="" class="row row531">
            <div id="ctl00_cphBeforeMiddleRight_pnl00cphBeforeMiddleRight_132"
                 class="col-cms col-md-12 newsSlider dateStyle" style="padding-right: 0">
                <div class="inner ">
                    <div class="panel panel-style2 ">
                        <div class="">
                            <div id=""
                                 class="lightSliderWrapper noPrint">
                                <div id=""
                                     class="col-cms col-lg-12 col-md-12 customNewsList titleCount padding-bottom-20 margin-bottom-20">
                                    <div class="inner">
                                        <div id="" class="row">
                                            <div id="content" class="col-sm-12">

                                                <div class="form-group">
                                                    <article class="article-info">

                                                        @if(!empty($successMsg))
                                                            <div class="alert alert-success"> {{ $successMsg }}</div>
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $('input').val("");
                                                                    $('textarea').text("");
                                                                });
                                                            </script>
                                                        @endif

                                                        @if (count($errors) > 0)
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif

                                                        <form action="{{ route('contactus.post') }}" id="frm1" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                            {{ csrf_field() }}
                                                            <fieldset id="account">



                                                                @include('partials.text' , ['field_title' => trans('auth.email') , 'field_name' => 'email','star'=>true ,'icon'=>false ])
                                                                <div class="form-group">
                                                                    <label class="control-label" for="input_text"><span class="text-danger">*</span> @lang('custom.text'):</label>
                                                                    {!! Form::textarea('text', '',['class' => 'form-control','style'=>'height: 88px;','id' => 'input_text' ]) !!}
                                                                </div>

                                                            </fieldset>
                                                            <div class="buttons">
                                                                <div class="pull-right">
                                                                    <input type="submit" value="@lang('custom.send')" class="btn btn-primary btnFromSave">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                        </form>
                                                    </article>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('style')

    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr-rtl.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@push('script')
<script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.btnFromSave').click(function () {
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
                    $.each(JSON.parse(jqXhr.responseText), function (key, value) {
                        toastr.error(value[0]);
                    });
                    $this.prop('disabled', false);
                } else
                    $this.prop('disabled', false);
                return false;
            });
            return false;
        });


    });



</script>

@endpush
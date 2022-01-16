<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label" for="input_service_id">@if(isset($star))<span class="text-danger">*</span>@endif
                {{ $field_title }} :
            </label><br/>

            <div class="input-group">
                <div class="input-group-addon" data-mddatetimepicker="true" data-targetselector="#input_{{ $field_name }}" data-trigger="click" data-enabletimepicker="true">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
                <input value="{{ isset($data)?$data:'' }}" style="text-align: center; direction: ltr; font-family: inherit" readonly type="text" class="form-control"
                       name="{{ $field_name }}" id="input_{{ $field_name }}" placeholder="{{ $field_title }}"/>
            </div>

        </div>

    </div>
</div>




@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}">
@endpush

@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/calendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/Bootstrap-PersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>

<script>
    $(function () {
        $('#input_{{ $field_name }}')
                .addClass('input-group-addon')
                .attr('data-MdDateTimePicker', 'true')
                .attr('data-enabletimepicker', 'true')
                .attr('readonly', 'true')
        ;
        $('#input_{{ $field_name }}').MdPersianDateTimePicker({Placement: 'right'});
    });
</script>
@endpush
<div class="form-group clearfix">
    @php
        $items = [];
        if(isset($options))
            $items = $options;
    @endphp
    <label class="control-label" for="{{ $field_name }}">@if(isset($star))<span class="text-danger">*</span>@endif{{ $field_title }}:</label>
    <select name="{{ $field_name }}@if(isset($multiple))[]@endif" id="{{ $field_name }}" class="form-control"  @if(isset($multiple))multiple="multiple"@endif >
            @if(is_array($items))
                @foreach($items as $key => $value)
                    <option value="{{ (isset($tag))?$value:$key }}" selected>{{ $value }}</option>
                @endforeach
            @else
                <option value="{{ $items }}" selected>{{ $items }}</option>
            @endif
    </select>

</div>

@push('style')
<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/select2_4.0.0/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@push('script_lib')
<script src="{{ asset('assets/plugins/select2_4.0.0/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2_4.0.0/js/i18n/'.App::getLocale().'.js') }}"></script>
@endpush




@push('script')
<script>
    $(document).ready(function () {
        $("#{{ $field_name }}").select2({
            dir: 'rtl',
            @if(isset($tag))
                tags: true,
                minimumInputLength: 2,
            @endif
            @if(!isset($multiple)) maximumSelectionLength: 1, @endif
            placeholder: '{{ Lang::get('custom.tag_placeholder') }}',
            language: '{{ config('app.locale') }}',
            @if(isset($route))
            ajax: {
                url: '{{ route($route) }}',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    var arr = [];
                    for (var i in data.rows) {
                        arr.push({
                            @if(!isset($tag) || $tag)
                            id: data.rows[i].title,
                            @else
                            id: data.rows[i].id,
                            @endif
                            text: data.rows[i].title,
                            _raw: data.rows[i]  // for convenience
                        });
                    }

                    return {
                        results: arr,
                        pagination: {
                            more: (params.page * 30) < data.total
                        }
                    };
                },
                cache: true
            },
            @endif
            escapeMarkup: function (markup) { return markup; } // let our custom formatter work

        });
    });
</script>
@endpush
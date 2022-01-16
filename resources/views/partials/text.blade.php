<div class="form-group">
    <label class="control-label" for="input_title">@if(isset($star))<span class="text-danger">*</span>@endif {{ $field_title }}:</label>
    <div class="input-icon">
        @if(!isset($icon))
            <i class="fa fa-bell-o"></i>
        @endif
        @php
            if(isset($data))
                $val = $data;
            else if (isset($news->{$field_name}))
                $val = $news->{$field_name};
            else
                $val = ''
        @endphp
        {!! Form::text($field_name, $val,['class' => 'form-control','id' => 'input_' . $field_name]) !!}
    </div>
</div>
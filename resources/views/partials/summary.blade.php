<div class="form-group">
    <label class="control-label" for="input_summary">@if(isset($star))<span class="text-danger">*</span>@endif{{ $field_title }}:</label>
    <div class="input-icon">
        <i class="fa fa-bell-o"></i>
        {!! Form::textarea($field_name, null, ['id' => 'input_'.$field_name, 'rows' => isset($rows) ? $rows : 6,'class' => 'form-control']) !!}
    </div>
</div>
<label class="col-sm-2 control-label" for="input_title">@if(isset($star))<span class="text-danger">*</span>@endif {{ $field_title }}:</label>
<div class="col-sm-4">
    {!! Form::text($field_name, ( isset($data)?$data:'' ),['class' => 'form-control','placeholder' => $field_title ,'id' => 'input_' . $field_name]) !!}
</div>
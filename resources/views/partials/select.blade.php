<div class="form-group">
    <label class="control-label" for="input_service_id">@if(isset($star))<span
                class="text-danger">*</span>@endif{{ $field_title }} :</label>
    <div class="input-icon">
        @if(!isset($icon))
            <i class="fa fa-question"></i>
        @endif
        {!! Form::select( $field_name , $data , isset($selected) ? $selected : null , ['class' => 'form-control' , 'id'=>$field_name]) !!}
    </div>
</div>
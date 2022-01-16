<label class="col-sm-2 control-label" for="product-company">
    @if(isset($star))
        <span class="text-danger">*</span>@endif{{ $field_title }} :
</label>

<div class="col-sm-4">

    @if(isset($multiple))
        {!! Form::select( $field_name.'[]' , $data , isset($selected) ? $selected : null , ['class' => 'form-control' , 'id'=>$field_name.'[]' , 'multiple'=>'multiple' ]) !!}
    @else
        {!! Form::select( $field_name , $data , isset($selected) ? $selected : null , ['class' => 'form-control' , 'id'=>$field_name ]) !!}
    @endif

</div>
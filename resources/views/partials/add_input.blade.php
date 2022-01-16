<div class="row">
    <label class="control-label col-md-12">@if(isset($star))<span class="text-danger">*</span>@endif{{ $field_title }}</label>
    @php
        $i=0;
    @endphp

@if(isset($data) && !empty($data))
    @foreach($data as $v)
        <div class="form-group row {{ $field_name }}">
            <div class="col-xs-10">
                <div class="input-icon">
                    <i class="fa fa-question"></i>
                    <input type="text" class="form-control {{ $field_name }}" name="{{ $field_name }}[]" value="{{ $v }}" >
                </div>
            </div>
            <div class="col-xs-2">
                @if($i++>0)
                    <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                @else
                    <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="form-group row {{ $field_name }}">
        <div class="col-xs-10">
            <div class="input-icon">
                <i class="fa fa-question"></i>
                <input type="text" class="form-control {{ $field_name }}" name="{{ $field_name }}[]" >
            </div>
        </div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
        </div>
    </div>
@endif


    <div class="form-group row hide {{ $field_name }} optionTemplate" >
        <div class="col-xs-10">
            <div class="input-icon">
                <i class="fa fa-question"></i>
                <input type="text" class="form-control {{ $field_name }}" name="{{ $field_name }}[]" >
            </div>
        </div>

        <div class="col-xs-2">
            <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
        </div>
    </div>
</div>

@push('script')
  <script type="text/javascript">
  $(function(){
      $(document)
              .delegate('.removeButton','click',  function() {
                  var $row = $(this).parents('.form-group');
                  $row.remove();
              })
              .delegate('.{{ $field_name }}.row .addButton','click',function(event){
                  var $template = $('.{{ $field_name }}.optionTemplate:last'),
                          $clone    = $template
                                  .clone()
                                  .removeClass('hide')
                                  .removeAttr('id')
                                  .insertBefore($template)
                                  .find('input').val('');
                  event.stopPropagation();
              });
    });
    </script>
@endpush

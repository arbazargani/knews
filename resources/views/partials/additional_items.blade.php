<div class="row">
    <label class="control-label col-md-12">@if(isset($star))<span class="text-danger">*</span>@endif{{ $field_title }}</label>
    <div class="form-group">
        <div class="col-xs-4 text-center">
            {{ Lang::get('custom.field_title') }}
        </div>
        <div class="col-xs-4 text-center">
            {{ Lang::get('custom.field_value') }}
        </div>
        <div class="col-xs-4">
            &nbsp;
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="text" name="{{ $field_name }}_titles[]"/>
        </div>
        <div class="col-xs-4">
            <input class="form-control" type="text" name="{{ $field_name }}_values[]"/>
        </div>
        <div class="col-xs-4">
            <button type="button" class="btn btn-default {{ $field_name }}_addButton"><i class="fa fa-plus"></i></button>
        </div>
    </div>

    <div class="form-group hide" id="{{ $field_name }}_template">
        <div class="col-xs-4">
            <input class="form-control" type="text" name="{{ $field_name }}_titles[]"/>
        </div>
        <div class="col-xs-4">
            <input class="form-control" type="text" name="{{ $field_name }}_values[]"/>
        </div>
        <div class="col-xs-4">
            <button type="button" class="btn btn-default {{ $field_name }}_removeButton"><i class="fa fa-minus"></i></button>
        </div>
    </div>
<?php //dd($news->{$field_name.'_titles'}[1]);
    ?>
</div>
@push('script')
    <script>
        $(function(){
            @if(isset($news->{ $field_name.'_titles' }) && is_array($news->{ $field_name.'_titles' }) && count($news->{ $field_name.'_titles' })>0)
                $('input[name="{{ $field_name }}_titles[]"]').val('{{ $news->{$field_name.'_titles'}[0] }}')
                $('input[name="{{ $field_name }}_values[]"]').val('{{ $news->{$field_name.'_values'}[0] }}')
                    @if(count($news->{ $field_name.'_titles' })>1)
                        @for($i=1;$i<count($news->{$field_name.'_titles'});$i++)
                                var $template = $('#{{ $field_name }}_template');
                                    $clone = $template
                                            .clone()
                                            .removeClass('hide')
                                            .removeAttr('id')
                                            .insertBefore($template);
                                    $clone.find('input[name="{{ $field_name }}_titles[]"]').val('{{  $news->{$field_name.'_titles'}[$i] }}');
                                    $clone.find('input[name="{{ $field_name }}_values[]"]').val('{{  $news->{$field_name.'_values'}[$i] }}');
            console.log($clone.val());
                        @endfor
                    @endif
            @endif
          $(document).ready(function(){
                $(document)
                        .delegate('.{{ $field_name }}_removeButton','click',  function() {
                            var $row = $(this).parents('.form-group');
                            $row.remove();

                        })
                        .delegate('.{{ $field_name }}_addButton','click',function(){
                            var $template = $('#{{ $field_name }}_template');
                                    $clone = $template
                                            .clone()
                                            .removeClass('hide')
                                            .removeAttr('id')
                                            .insertBefore($template)
                                            .find('input').val('');


                        });
            });
        });
    </script>
@endpush
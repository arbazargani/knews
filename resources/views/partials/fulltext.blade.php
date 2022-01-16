<div class="form-group">
    <label class="control-label" for="input_summary">@if(isset($star))<span class="text-danger">*</span> @endif {{ $field_title }}:</label>
    <div class="input-icon">
        <i class="fa fa-bell-o"></i>
        {!! Form::textarea($field_name, isset($news)?$news->full_text:isset($data)?$data:'', ['id' => $field_name, 'rows' => isset($rows) ? $rows : 6,'class' => 'form-control']) !!}
    </div>
</div>

@if(!isset($GLOBALS['ckeditor']))
@push('script_lib')
<script src="{{ asset('assets/plugins/ckeditor-4.4.5/ckeditor.js') }}"></script>
<script src="{{ asset('assets/packs/ckeditor/adapters/jquery.js') }}"></script>
@endpush
@endif
@push('script')
<?php $GLOBALS['ckeditor']=true; ?>
<script>
    $(function(){

        /*CKEDITOR.replace('{{ $field_name }}', {
            language: '{{ config('app.locale') }}',
            toolbar :'MyBasic'
        });*/
        $('textarea#{{ $field_name }}').ckeditor();

        function processFileEditor(file) {
                fi = '{{url('')}}' + file.url;
                $('[id^="cke_Upload_"]').each(function () {
                    $(this).remove();
                });
                $('.cke_dialog_ui_input_text').each(function () {
                    if ($(this).is(':visible')) {
                        $(this).children().val(fi);
                        return false;
                    }
                });
            }
    })
</script>
@endpush
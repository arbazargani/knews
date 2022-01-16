
<div class="form-group">
    <label class="control-label">{{ $field_title }}</label>
    <div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-group input-group-fixed" style="width: 100%">
                <div id="{{$field_name}}_fileuploader">
                    <span class="fileupload-new"><i class="icon-paper-clip"></i>@lang('custom.select_file')</span>
                </div>
                {!! Form::hidden($field_name, null, ['id' => $field_name.'_file_pic']) !!}
                <div class="msg">
                    @if( !empty($news->file_url) )
                        <a href="{{ url('files/'.$news->user_id.'/'.$news->{$field_name} ) }}" target="_blank" class="btn btn-success" style="margin-top:5px">{{ Lang::get('custom.view_file') }}</a>
                    @endif

                </div>
                <div id="{{$field_name}}_eventsmessage">
                </div>
            </div>
        </div>
    </div>
</div>

@push('style')
<link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
<style>
    .li-up{
        text-align: center;
        list-style: outside none none; border: 1px solid; float: right; margin: 5px; padding: 5px; width: 200px; height: 150px;
    }
</style>
@endpush

@push('script_bottom')
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
<script>
    $(document).ready(function() {
        @if(isset($data))
            $("#{{$field_name}}_file_pic").val('{{ $data }}');
        @else
            $("#{{$field_name}}_file_pic").val();
        @endif

        $("#{{$field_name}}_fileuploader").uploadFile({
            url: "{{ route('upload_file') }}",
            formData: {"upload_dir": "files", "thumb": "no",'_token':'{{ csrf_token() }}' },
            showStatusAfterSuccess: false,
            showAbort: false,
            showDone: false,
            allowedTypes: "{{$file_types}}",
            fileName: "myfile",
            returnType: 'json',
            dataType: 'json',
            multiple: true,
            dragDrop:true,
            onSubmit: function (files) {
            },
            onSuccess: function (files, data, xhr) {
                var json_data = JSON.stringify(data);
                var new_data = data[0].filename;
                $("#{{$field_name}}_file_pic").val(new_data);
                var resp = data[0].filename;
                var resp_org = data[0].org_filename;

                @if(isset($type))
                    @if($type == 'image')
                        $('.msg').append('<li class="li-up"><img style="height: 120px; width: 165px;" snattr="'+new_data+'" src="{{ url('files') }}/'+ new_data +'" /> <br/> <a id="li_up_a" style="cursor: pointer;">حذف</a> </li>');
                @endif
            @else
                $('.msg').append('<li>@lang('custom.success_send_file'):'+ resp_org +'</li>');
                @endif

            },
            afterUploadAll: function () {
            },
            onError: function (files, status, errMsg) {
                $("#{{$field_name}}_eventsmessage").html($("#{{$field_name}}_eventsmessage").html() + "<br/>Error for: " + JSON.stringify(files));
            }
        });

        $(document).on("click", "#li_up_a", function() {
            $(this).parent().remove();
        });



    });
</script>
@endpush

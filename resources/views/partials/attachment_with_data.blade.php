
<div class="form-group">
    <label class="control-label">{{ $field_title }}</label>
    <div>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-group input-group-fixed">
                <div id="{{$field_name}}_fileuploader">
                    <span class="fileupload-new"><i class="icon-paper-clip"></i>{{ Lang::get('custom.select_file') }}</span>
                </div>
                {!! Form::hidden($field_name, null, ['id' => $field_name.'_file_pic']) !!}
                <div class="msg">
                    @if( !empty($file_name)  )
                        @if( !file_exists(public_path(($file_name == "files/images/user.png" ? '' : $base_url . '/').$file_name)))
                            <img src="{{  image_url("files/images/user.png",100,120)  }}">
                        @elseif(is_image(public_path(($file_name == "files/images/user.png" ? '' : $base_url . '/').$file_name)))
                            <img src="{{  image_url(($file_name == "files/images/user.png" ? '' : $base_url . '/').$file_name,100,120)  }}">
                        @else
                            <a href="{{ url($base_url.$file_name ) }}" target="_blank" class="btn btn-success" style="margin-top:5px">{{ Lang::get('custom.view_file') }}</a>
                        @endif
                    @endif

                </div>
                <div id="{{$field_name}}_eventsmessage">
                </div>
            </div>
        </div>
    </div>
</div>
@if(!isset($GLOBALS['uploader']))
@push('style')
<link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
@endpush

@push('script_lib')
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
@endpush
@endif
<?php $GLOBALS['uploader'] = true; ?>
@push('script')
<script>
    $(document).ready(function() {
        $('#file_pic').val();

        $("#{{$field_name}}_fileuploader").uploadFile({
            url: "{{ route('upload_file') }}",
            formData: {"upload_dir": "files", "thumb": "no",'_token':'{{ csrf_token() }}' @if(isset($user_id)), 'user_id':'{{$user_id}}' @endif},
            showStatusAfterSuccess: false,
            showAbort: false,
            showDone: false,
            allowedTypes: "{{$file_types}}",
            fileName: "myfile",
            returnType: 'json',
            dataType: 'json',
            onSubmit: function (files) {
            },
            onSuccess: function (files, data, xhr) {
                var json_data = JSON.stringify(data);
                var new_data = data[0].filename;
                $("#{{$field_name}}_file_pic").val(new_data);
                var resp = data[0].filename;
                var resp_org = data[0].org_filename;

                $('.msg').append('<li>فایل '+ resp_org +' به درستی ارسال شد.</li>');

            },
            afterUploadAll: function () {
            },
            onError: function (files, status, errMsg) {
                $("#{{$field_name}}_eventsmessage").html($("#{{$field_name}}_eventsmessage").html() + "<br/>Error for: " + JSON.stringify(files));
            }
        });
    });
</script>
@endpush
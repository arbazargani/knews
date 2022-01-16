<table style="direction: rtl">
<tr id="tr_file_url">
    <th nowrap="" style="width: 1%"><span class="text-danger">*</span>ارسال فایل:</th>
    <td>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-group input-group-fixed">
                <div id="file_url_fileuploader">
                    <span class="fileupload-new"><i class="icon-paper-clip"></i>انتخاب فایل</span>
                </div>
                @if( isset($data) )
                    <input type="hidden" value="" id="file_url" name="ارسال فایل">
                    <div class="file_url_msg">

                    </div>
                @else
                    <input type="hidden" id="file_url" name="ارسال فایل">
                    <div class="file_url_msg">

                    </div>
                @endif
                <div id="file_url_eventsmessage">
                </div>
            </div>
        </div>
    </td>
</tr>
</table>
<link rel="stylesheet" href="{{ asset('assets/styles/uploadfile.css') }}">
<script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.form.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery.uploadfile.js') }}"></script>


<style>
    .img-upload {
        border: 1px solid buttonshadow;
        margin: 10px;
        padding: 10px;
        width: 500px;
    }
</style>


<script>
    $(document).ready(function () {
        $("#file_url_fileuploader").uploadFile({
            url: "{{ route('upload_file') }}",
            formData: {
                "upload_dir": "files",
                "thumb": "no",
                '_token': '{{ csrf_token() }}',
                "name": "myfile"
            },
            showStatusAfterSuccess: false,
            showAbort: false,
            showDone: false,
            allowedTypes: "jpg,jpeg,png",
            fileName: "myfile",
            returnType: 'json',
            dataType: 'json',
            multiple: 'false',
            onSubmit: function (files) {
            },
            onSuccess: function (files, data, xhr) {
                var json_data = JSON.stringify(data);
                var new_data = data[0].filename;
                $("#file_url").val(new_data);
                var resp = data[0].filename;
                var resp_org = data[0].org_filename;
                count_img = $('.file_url_msg').find('img').length + 1;
                img = '/files/'+data[0].filename;
                console.log(img);
                window.opener.processFileEditor('/files/'+data[0].filename);
                window.close();
            },
            afterUploadAll: function () {
            },
            onError: function (files, status, errMsg) {
                $("#file_url_eventsmessage").html($("#file_url_eventsmessage").html() + "<br/>ارسال خطا برای : " + JSON.stringify(files));
            }
        });

    });
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>مدیریت فایل ها</title>

    <!--<link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/jquery-ui/jquery-ui.min.css') }}">-->
	<!-- ToDO: Local css -->
    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/elfinder/css/theme.css')  }}">

    <script type="text/javascript" src="{{ url('assets/plugins/jquery-1.12.0.min.js')  }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/elfinder/js/elfinder.min.js')  }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/elfinder/js/i18n/elfinder.fa.js')  }}"></script>

    <script type="text/javascript" charset="utf-8">

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $('#filemanagerDIV').elfinder({
                costomData: {
                    _token: '{{ csrf_token() }}'
                },
                lang : 'fa',
                url : '{{ route('admin.filemanager.create') }}' ,
                commandsOptions : {
                    getfile : {
                        @if(isset($_set_multiple))
                            multiple : true,
                        @else
                            multiple : false,
                        @endif
                    },
                },
                getFileCallback : function(file) {
                    //console.log(file);
                    //window.opener.{{$type_filemanager}}(file.url);
                    window.opener.{{$type_filemanager}}(file);
                    window.close();
                },
                resizable: true
            }).elfinder('instance');
            $('.elfinder-button-icon-help').parent().parent().remove();
        });
    </script>
</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="filemanagerDIV"></div>

</body>
</html>

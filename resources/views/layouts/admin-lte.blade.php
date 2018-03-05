<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">

        <title>{!!ENV('APP_NAME_DESCRIPTION')!!}</title>
        <link sizes="60x60" rel="shortcut icon" href="{{url('/imgs/favicon.png')}}" type="image/x-icon"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="base_url" content="{{ url('/') }}">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ("/bower_components/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("/bower_components/pace-master/themes/white/pace-theme-minimal.css")}}" rel="stylesheet" type="text/css" />
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/daterangepicker/moment.min.js") }}" type="text/javascript"></script>  
        <link href="{{ asset("/bower_components/select2-4.0.2/dist/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
        <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("/bower_components/AdminLTE/plugins/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("/assets/js/before.js") }}?rndstr={{uniqid()}}" type="text/javascript"></script>
        <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <link href="{{ asset("/bower_components/css3-animate-it/css/animations.css")}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/assets/css/admin-lte.css")}}" type="text/css" />
        <link rel="stylesheet" href="{{ asset("/assets/css/bootstrap-modify.css")}}" type="text/css" />
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQueryUI/jquery-ui.min.js") }}" type="text/javascript"></script>               
        <link href="{{ asset("/bower_components/jquery-ui-bootstrap/css/custom-theme/jquery-ui-1.10.0.custom.css") }}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/bower_components/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/bower_components/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link href="{{ asset("/bower_components/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css")}}" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue sidebar-mini {{\Request::get('sidebar')}}" id="body">

        <div class="wrapper">
            @include('layouts.admin-lte.partial.header')
            @include('layouts.admin-lte.partial.sidebar')
            @yield('content')
        </div>

        <script src="{{ asset ("/bower_components/select2-4.0.2/dist/js/select2.full.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("/bower_components/jquery-mask/jquery.mask.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset ("/bower_components/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js") }}" type="text/javascript"></script>    
        <script src="{{ asset ("/assets/js/adminlte-settings.js") }}" type="text/javascript"></script>
        <script data-pace-options='{ "ajax": true }' src="{{ asset ("/bower_components/pace-master/pace.min.js") }}" type="text/javascript"></script>    
        <script src="{{ asset ("/assets/js/script.js?version=01") }}?rndstr={{uniqid()}}" type="text/javascript"></script>    
        <script src="{{ asset ("/bower_components/css3-animate-it/js/css3-animate-it.js") }}" type="text/javascript"></script>
    </body>
</html>
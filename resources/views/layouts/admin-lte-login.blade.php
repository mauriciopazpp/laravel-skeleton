<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faça o login</title>
    <link sizes="60x60" rel="shortcut icon" href="/imgs/favicon.png" type="image/x-icon"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />   
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/libs/animate.css-master/animate.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/assets/css/style.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
    <script src="{{ asset ("/assets/js/inativity.js") }}"></script>
</head>
<body class="layout-boxed">
    <div class="animated fadeIn">
        @yield('content')
    </div>
</body>
</html>
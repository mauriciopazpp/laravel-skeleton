@extends('layouts.admin-lte-login')

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b style="color: white;">{!!env('APP_NAME_SHORT_1')!!} </b></a>
        </div>
        <div class="login-box-body">
        @include('partials.error-block')
            <p class="login-box-msg">Redefinição de senha</p>
           
           <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password_confirmation">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Redefinir Senha
                    </button>
                </div>
            </div>
           </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
@endsection

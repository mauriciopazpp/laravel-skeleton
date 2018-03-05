@extends('layouts.admin-lte-login')

@section('content')
<body class="hold-transition login-page animated fadeIn">
    <div class="login-box">
        <div class="login-logo row"><b>{!!env('APP_NAME_SHORT_1')!!}</b>
        </div>
        <div class="login-box-body">
            @include('partials.error-block-animated')
            <p class="login-box-msg">Faça login para iniciar sua sessão</p>
            <form method="POST" url="/login" role="form">
                <div class="form-group has-feedback">
                    <input name="email" value="{{old('email')}}" id="email" class="form-control" placeholder="Entre com o seu E-mail"></input>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="form-group has-feedback">
                    <input autocomplete="off" name="password" type="password" class="form-control" placeholder="Digite sua senha"></input>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>
            </form>
            <br>
            <a href="{{url('/password/reset')}}">Eu esqueci minha senha</a>
        </div>
    </div>
    <div style="text-align: center;margin-bottom: 25px;font-weight: 300;font-size:16px">
        {!!env('APP_NAME_DESCRIPTION')!!}
    </div>
</body>
@endsection
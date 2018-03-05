@extends('layouts.admin-lte-login')

@section('content')
<body class="hold-transition login-page animated fadeIn">
    <div class="login-box">
        <div class="login-logo row"><b>{!!env('APP_NAME_SHORT_1')!!}</b></div>
        <div class="login-box-body">
            @include('partials.error-block-animated')
            @include('partials.flash-messages')
            <p class="login-box-msg">Insira o email que você utiliza para acessar o sistema e clique em enviar</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar o link de redefinição!</button>
                </div>
            </form>
        </div>
    </div>
    <div style="text-align: center;margin-bottom: 25px;font-weight: 300;font-size:16px">
        {!!env('APP_NAME_DESCRIPTION')!!}
    </div>
</body>
@endsection
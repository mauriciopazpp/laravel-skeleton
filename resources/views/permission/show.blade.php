@extends('layouts.admin-lte')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        @include('partials.error-block')
        <h1>
            Recursos <small>Administrador de recursos</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detalhe do recurso</h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="form-group col-xs-12 col-sm-6 col-md-4">
                            <p>Nome legível: <b>{{$permission->readable_name}}</b></p>
                            <p>Nome: <b>{{$permission->name}}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection

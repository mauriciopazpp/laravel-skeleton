@extends('layouts.admin-lte')

@section('content')

<div class="content-wrapper">
    <div class="col-xs-12">
        <section class="content-header">
            @include('partials.error-block')
            <h1>
                Criando novo Grupo <small>Administrador de grupos</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="box box-primary">                    
                    <form action="{{url('/')}}/role/store" method="POST">
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <label for="name">Nome do Grupo</label>
                                <input required name="name" type="text"  class="form-control" id="name" placeholder="Nome do Grupo">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-info">Limpar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>


@endsection

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
                        <h3 class="box-title">Editando recurso {{$permission->name}}</h3>
                    </div>
                    
                    <form method="POST" action="{{url('/permission/update/')}}">
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            
                            <div class="form-group col-xs-12 col-sm-6 col-md-1">
                            <label for="name">ID</label>
                            <input class="form-control" type="text" readonly name="id" value="{{ $permission->id }}" />
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <label for="name">Nome do Grupo</label>
                                <input required name="readable_name" type="text" value="{{$permission->readable_name}}" class="form-control" id="name" placeholder="Nome Legível">
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <label for="name">Nome</label>
                                <input required name="name" type="text" value="{{$permission->name}}" class="form-control" id="name" placeholder="Nome do Grupo">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-info">Resetar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection

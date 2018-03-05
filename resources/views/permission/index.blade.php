@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.flash-messages')
            <h1>
                Recursos <small>administrador de recursos</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Recursos cadastrados</h3>
                        </div>
                        <div class="box-body">
                            @if(count($permissions) > 0)
                            <table class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome legível</th>
                                    <th>Nome</th>
                                    <th>Criado</th>
                                    <th>Atualizado</th>
                                    <th width="170px">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->readable_name}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->created_at->format('d/m/Y \à\s H:m:i')}}</td>
                                        <td>{{$permission->updated_at->format('d/m/Y \à\s H:m:i')}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Ações
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{url('/permission/'.$permission->id . '/show/')}}">Ver</a></li>
                                                    <li><a href="{{url('/permission/'.$permission->id . '/edit/')}}">Editar</a></li>

                                                    <li><a href="{{url('/permission/'.$permission->id . '/destroy/')}}" onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-info"> Nenhum registro encontrado </div>
                            @endif
                            <div class="col-xs-12 text-center">
                                {!!$permissions->render()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

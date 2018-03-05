@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.flash-messages')
            @include('partials.error-block')
            <h1>
                Grupos <small>administrador de grupos</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            @if(count($roles) > 0)
                            <table class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome do Grupo</th>
                                    <th>Criado</th>
                                    <th>Atualizado</th>
                                    <th width="100px">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr class="{{$role->id == \App\Model\Role::SUPERUSER ? 'alert-success': ''}}">
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{url('/role/' . $role->id)}}/show">{{$role->name}} {{$role->name == 'Developer' ? '- SUPERUSER': ''}}</a></td>
                                        <td>{{$role->created_at->format('d/m/Y \à\s H:i:s')}}</td>
                                        <td>{{$role->updated_at->format('d/m/Y \à\s H:i:s')}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Ações
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{url('/role/' . $role->id . '/show')}}">Ver</a></li>
                                                    <li><a href="{{url('/role/' . $role->id . '/edit')}}">Editar</a></li>
                                                    @if($role->name != 'Developer')
                                                    <li><a href="{{url('/role/' . $role->id . '/destroy')}}" onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</a></li>
                                                    @endif
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
                                {!!$roles->render()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

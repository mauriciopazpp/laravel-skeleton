@extends('layouts.admin-lte')

@section('content')

<div class="content-wrapper">
    <div class="col-xs-12">
        <section class="content-header">
            @include('partials.error-block')
            <h1>
                {{$role->name}}
                <small>Administrador de grupos</small>
            </h1> 
        </section>

        <section class="content">
            <div class="row">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="box-body no-padding">
                            @if(count($role->users) > 0)
                                <div class="col-xs-12 col-sm-6">
                                    <label>Usuários que pertecem a este grupo</label>
                                    <ul class="users-list  clearfix">
                                       @each('role.partials.user', $role->users , 'user', '')
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <label>Permissões deste grupo:</label>
                                    <ul class="clearfix">
                                       @foreach($role->permissions as $permission)
                                        <li>
                                            {{$permission->readable_name}}
                                        </li>
                                       @endforeach
                                    </ul>
                                </div>
                            @else
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Nenhum usuário pertence a este grupo!
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{url('role')}}" class="btn btn-primary">Listar todos</a>
                        @shield('role.edit')
                            <a href="{{url('/role/' . $role->id . '/edit')}}" class="btn btn-primary">Editar</a>
                        @endshield
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

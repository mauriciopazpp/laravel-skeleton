@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.flash-messages')
            <h1>Usuários</h1>
        </section>
 
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form action="{{url('/user')}}" method="GET" class="form-inline">
                               @include('users.partial.filters')
                            </form>  
                            @if(count($users) > 0)
                            <table class="table table-bordered table-striped table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th width="40">Foto</th>
                                    <th>Nome</th>
                                    <th class="hidden-xs">Grupos</th>
                                    <th class="hidden-xs">Email</th>
                                    <th class="hidden-xs">Criado em</th>
                                    <th class="hidden-xs">Atualizado em</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr style="background:{{$key%2==0? 'rgba(234, 234, 234, 0.78)':''}}">
                                        <td>
                                            <img width="35" src='{{url('/user/picture/' . ($user->picture ? $user->picture : 'name.png'))}}' class="img-circle" alt="User Image" />
                                        </td>
                                        <td>
                                            <a title="Ver detalhes" href="{{url('/user/' . $user->id . '/show')}}">
                                                {{$user->name}}
                                            </a>
                                        </td>
                                        <td class="hidden-xs">
                                            @foreach($user->roles as $role)
                                                {{$role->name}}
                                                @if($role != $user->roles->last())
                                                    ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="hidden-xs">
                                            {{$user->email}}
                                        </td>
                                        <td class="hidden-xs">{{$user->created_at->format('d/m/Y \à\s H:i:s')}}</td>
                                        <td class="hidden-xs">{{$user->updated_at->format('d/m/Y \à\s H:i:s')}}</td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                                              <i class="fa fa-pencil"></i> Ações
                                              <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                                <li>
                                                    <form method="POST" action="{{url('/user/' . $user->id . '/destroy')}}">
                                                        {{ method_field('DELETE') }}
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <button class="btn btn-link" {{$user->id == Auth::user()->id ? 
                                                            'disabled' : ''}} style="color:#777;margin: 0 0 -7px 5px; " 
                                                            onclick="return confirm('Tem certeza que deseja excluir este item?');">
                                                                <i class="fa fa-close"></i> Excluir
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><a href="{{url('/user/' . $user->id . '/edit')}}"><i class="fa fa-pencil"></i> Editar</a></li>
                                              </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-info">
                                    Nenhum registro encontrado.
                                </div>
                            @endif
                        </div>
                        <div class="col-xs-12 text-center">
                            @if($request->all())
                                {!!$users->appends($request->all())->render()!!}
                            @else
                                {!!$users->render()!!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

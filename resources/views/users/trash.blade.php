@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.flash-messages')
            <h1>Usuários excluídos</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            @if(count($users) > 0)
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nome</th>
                                        <th class="hidden-xs">Criado em</th>
                                        <th class="hidden-xs">Atualizado em</th>
                                        <th class="hidden-xs">Excluído em</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr class="danger">
                                            <td>{{$user->id}}</td>
                                            <td>
                                                <a title="Ver detalhes" href="{{url('/user/' . $user->id . '/show')}}">
                                                    {{$user->name}}
                                                </a>
                                            </td>
                                            <td class="hidden-xs">{{$user->created_at->format('d/m/Y \à\s H:i:s')}}</td>
                                            <td class="hidden-xs">{{$user->updated_at->format('d/m/Y \à\s H:i:s')}}</td>
                                            <td class="hidden-xs">{{\Carbon\Carbon::parse($user->deleted_at)->format('d/m/Y \à\s H:i:s')}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Ações
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li>
                                                        <form method="POST" action="{{url('/user/' . $user->id . '/restore')}}">
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            <button class="btn btn-link btn-dropdown"
                                                                    onclick="return confirm('Tem certeza que deseja restaurar este item?');">
                                                                    Restaurar</button>
                                                        </form>
                                                        </li>
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
                            {!!$users->render()!!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">            
            @include('partials.flash-messages')
            @include('partials.error-block')
            <h1>Usuários online <a href="?" class="btn btn-success btn-sm">Atualizar</a></h1>
        </section>
 
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            @if(count($sessions) > 0)
                            <table class="table table-bordered table-striped table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>Usuário</th>
                                    @if(\Defender::hasRole('superuser'))
                                        <th>IP</th>
                                    @endif
                                    <th class="hidden-xs">Máquina</th>
                                    <th class="hidden-xs">Navegador</th>
                                    <th>Última atividade</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sessions as $key => $session)
                                    @if($session->user_id)
                                        <?php $user = $session->user; ?>
                                        @if($session->user_id != 0)
                                        <tr class="{{$session->ip_address == \Request::ip() ? 'info' : ''}}">
                                            <td>
                                                <img width="35" src='{{url('/user/picture/' . ($user->picture ? $user->picture : 'name.png'))}}' class="img-circle" alt="User Image" />
                                                <a title="Ver detalhes" href="{{url('/user/' . $user->id . '/show')}}">
                                                    {{$user->name}}
                                                </a>
                                            </td>
                                            @if(\Defender::hasRole('superuser'))
                                                <td>{{$session->ip_address}}</td>
                                            @endif
                                            <td class="hidden-xs" ip={{$session->ip_address}}>
                                                @if($session->ip_address == \Request::ip())
                                                    Este computador
                                                @else
                                                    Outro computador
                                                @endif
                                            </td>
                                            <td  class="hidden-xs">
                                                <?php 
                                                if(strpos($session->user_agent, 'MSIE') !== FALSE)
                                                   echo 'Internet explorer';
                                                 elseif(strpos($session->user_agent, 'Trident') !== FALSE) //For Supporting IE 11
                                                    echo 'Internet explorer';
                                                 elseif(strpos($session->user_agent, 'Firefox') !== FALSE)
                                                   echo 'Mozilla Firefox';
                                                 elseif(strpos($session->user_agent, 'Chrome') !== FALSE)
                                                   echo 'Google Chrome';
                                                 elseif(strpos($session->user_agent, 'Opera Mini') !== FALSE)
                                                   echo "Opera Mini";
                                                 elseif(strpos($session->user_agent, 'Opera') !== FALSE)
                                                   echo "Opera";
                                                 elseif(strpos($session->user_agent, 'Safari') !== FALSE)
                                                   echo "Safari";
                                                 else
                                                   echo 'Outro navegador';
                                                ?>
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans()}} - 
                                                {{\Carbon\Carbon::createFromTimestamp($session->last_activity)->format('d/m/Y H:i:s')}}
                                            </td>
                                            <td>
                                                @if(\App\Model\Online::where('user_id', Auth::user()->id)->count() > 0 and Auth::user()->id == $session->user_id)
                                                    <a onclick="return confirm('Tem certeza que deseja derrubar todas as sessões do seu usuário?')" 
                                                    href="{{url('sessions/logout/' . $session->user_id)}}" class="btn btn-warning btn-sm">Deslogar</a>
                                                @else
                                                    <a onclick="alert('Você só pode deslogar o seu próprio usuário!')" disabled href="#" class="btn btn-default btn-sm">Deslogar</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endif
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
                                {!!$sessions->appends($request->all())->render()!!}
                            @else
                                {!!$sessions->render()!!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@extends('layouts.admin-lte')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        @include('partials.error-block-animated')
        @include('partials.flash-messages')
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                
                <div class="col-xs-12 no-padding">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header widget-user-header-show bg-black" style="background: url({{asset('/bower_components/AdminLTE/dist/img/photo1.png')}}) center center;">
                                    <h3 class="widget-user-username">{{$user->name}}</h3>
                                    <h5 class="widget-user-desc">{{$user->email}}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img src='{{url('/user/picture/' . ($user->picture ? $user->picture : 'name.png'))}}' class="img-circle" alt="User Image" />
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$user->email}}</h5>
                                                <span class="description-text">Email</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">
                                                    {{$user->created_at->format('d/m/Y \à\s H:i:s')}}
                                                </h5>
                                                <span class="description-text">Criado em</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">
                                                    {{$user->updated_at->format('d/m/Y \à\s H:i:s')}}
                                                </h5>
                                                <span class="description-text">Atualizado em</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                <div class="row"></div>
                <div class="col-xs-12 col-sm-4 no-padding">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Grupos que pertence</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                          @if(count($user->roles) > 0)
                          <ul class="products-list product-list-in-box">
                           @foreach($user->roles as $role)
                               <a href="{{url('role/' . $role->id . '/show')}}">
                                   <li class="item">
                                     <div class="acl-box product-img">
                                       <i class="fa fa-lock fa-5x font-skin-blue"></i>
                                     </div>
                                     <div class="product-info">
                                       <a href="{{url('role/' . $role->id . '/show')}}" class="product-title">{{$role->name}}
                                         <span class="label label-warning pull-right">{{$role->users->count()}}</span>
                                       </a>
                                           <span class="product-description">
                                             {{$role->name}}
                                           </span>
                                     </div>
                                   </li>
                               </a>
                           @endforeach
                          </ul>
                          @else
                          <small>Este usuário não está em nenhum grupo.</small>
                          @endif
                        </div>
                        <div class="box-footer text-center">
                          <a href="{{url('role')}}" class="uppercase">Ver todos os grupos </a>
                        </div>
                      </div>
                </div>
                <div class="row"></div>
                <div class="col-xs-12 no-padding">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="btn-group">
                                <a class="btn btn-primary" href="{{url('/user')}}"><i class="fa fa-list"></i> Listar todos</a>
                                <a class="btn btn-warning" 
                                    {{$user->id == Auth::user()->id || \Defender::canDo('user.edit') == true ? '' : 'disabled'}}  
                                    href="{{$user->id == Auth::user()->id || \Defender::canDo('user.edit') == true ? url('/user/' . $user->id . '/edit') : '#'}}">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>                            
                                <form method="POST" action="{{url('/user/' . $user->id . '/destroy')}}">
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button class="btn btn-danger" {{$user->id == Auth::user()->id || \Defender::canDo('user.destroy') == false ? 'disabled' : ''}} style="position:absolute;" onclick="return confirm('Tem certeza que deseja excluir este item?');">
                                            <i class="fa fa-close"></i> Excluir
                                    </button>
                                </form>                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

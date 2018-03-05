@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.error-block-animated')
            @include('partials.flash-messages')
            <h1>Editando um usuário</h1>
        </section>
 
        <section class="content">
            <div class="row">
                <form method="POST" action="{{url('/user/update')}}" enctype="multipart/form-data">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                                    <label for="name">ID</label>
                                    <input name="id" class="form-control" value="{{$user->id}}" type="text" readonly />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-10">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Nome</label>
                                            <input required name="name" value="{{$user->name}}" type="text" class="form-control"  placeholder="Nome">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Email</label>
                                            <input required name="email" value="{{$user->email}}" type="email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Alterar senha</label>
                                            <input name="password" type="password" class="form-control" placeholder="Senha">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Foto do perfil</label>
                                            <input name="picture" type="file" id="picture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(\Defender::hasRole('superuser'))
                          <div class="box box-primary">
                              <div class="box-body">
                                  <div class="form-group col-xs-12">
                                  <label for="name">Grupos</label><br>
                                     <?php $checked = '' ?>
                                     @foreach($roles as $role)
                                         @foreach($user->role as $roleUser)
                                             @if($role->id == $roleUser->id)
                                                 <?php $checked = 'checked'; break; ?>
                                             @else
                                                 <?php $checked = '' ?>
                                             @endif
                                         @endforeach
                                         <div class="col-xs-4 col-sm-3 no-padding">
                                             <div class="checkbox checkbox-primary">
                                                 <input {{$checked}} type="checkbox" id="checkboxRole{{$role->id}}" 
                                                 value="{{$role->id}}" name="role[]">
                                                 <label for="checkbox{{$role->id}}">
                                                     {{'#' .$role->id . ' ' . $role->name}}
                                                 </label>
                                             </div>
                                         </div>
                                     @endforeach
                                  </div>
                              </div>
                          </div>                        
                        @endif
                        <div class="box box-primary">
                            <div class="box-body">
                                <a class="btn btn-primary" href="{{url('/user')}}"><i class="fa fa-list"></i> Listar todos</a>  
                                <button type="reset" class="btn btn-info">Resetar</button>
                                <button type="submit" class="btn btn-success">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>

@endsection

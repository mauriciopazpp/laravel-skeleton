@extends('layouts.admin-lte')

@section('content')

<div class="content-wrapper">
    <div class="col-xs-12">
        <section class="content-header">
            @include('partials.error-block')
            <h1>
                Editando Grupo <small>Administrador de grupos</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="box box-primary">
                    <form method="POST" action="{{url('/role/update')}}">
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            
                            <div class="form-group col-xs-12 col-sm-6 col-md-1">
                            <label for="name">ID</label>
                            <input class="form-control" type="text" readonly name="id" value="{{ $role->id }}" />
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <label for="name">Nome do Grupo</label>
                                <input required name="name" type="text" value="{{$role->name}}" class="form-control" id="name" placeholder="Nome do Grupo" {{$role->id == \App\Model\Role::SUPERUSER ? 'readonly' : ''}}>
                            </div>
                        </div>
 
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group col-xs-12">
                                  <label for="name">Permissões</label>
                                  <small>- Permissões para o grupo</small><br>
                                  @if(count($permissions) > 0)
                                    <?php $checked = '' ?>
                                    @foreach($permissions as $permission)
                                      @foreach($role->permissions as $permissionRole)
                                        @if($permissionRole->id == $permission->id)
                                           <?php $checked = 'checked'; break; ?>
                                        @else
                                           <?php $checked = '' ?>
                                        @endif
                                        @endforeach
                                        <div class="col-xs-4 col-sm-3 no-padding">
                                          <div class="checkbox checkbox-primary">
                                            <input {{$checked}} type="checkbox" id="checkboxPermission{{$permission->id}}" 
                                            value="{{$permission->id}}" name="permission[]">
                                              <label for="checkbox{{$permission->id}}">
                                                {{'#' . $permission->id . ' ' . $permission->readable_name . ' - ' . $permission->name}} 
                                              </label>
                                          </div>
                                        </div>
                                    @endforeach
                                  @else
                                    <small>Não há permissões adicionais disponíveis para conceder a este usuário.</small>
                                  @endif
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-info">Resetar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>


@endsection

@extends('layouts.admin-lte')

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            @include('partials.error-block-animated')
            @include('partials.flash-messages')
            <h1>Criando um usuário</h1>
        </section>
 
        <section class="content">
            <div class="row">
                <form method="POST" action="{{url('/user/store')}}" enctype="multipart/form-data">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group col-xs-12 col-sm-12 col-md-2">
                                    <label for="name">ID</label>
                                    <input class="form-control" type="text" readonly />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-10">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Nome</label>
                                            <input required name="name" type="text" class="form-control" placeholder="Nome" value="{{$request['name']}}">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Email</label>
                                            <input required name="email" type="email" class="form-control" placeholder="Email" value="{{$request['email']}}">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Senha de acesso</label>
                                            <input required name="password" type="password" class="form-control" placeholder="Senha">
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6">
                                            <label for="name">Foto do perfil</label>
                                            <input name="picture" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group col-xs-12">
                                    <label>Grupos</label><br>
                                    <?php /*TODO: INSERIR GRUPO AO CADASTRAR USUÁRIO*/?>
                                    <span>Informe o grupo na edição</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box box-primary">
                            <div class="box-body">
                                <button type="reset" class="btn btn-info">Limpar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </section>
@endsection

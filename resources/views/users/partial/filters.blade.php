<tr>
    <th></th>
    <th> 
        <input value="{{$request->name}}" class="form-control input-sm" name="name" placeholder="Nome" value="{{$request->name}}" />
    </th>
    <th> 
        <input value="{{$request->email}}" class="form-control input-sm" name="email" placeholder="Email" value="{{$request->email}}" />
    </th>   
    <th style="width:100px">
        <div class="btn-group">
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-search"></i>
                Buscar
            </button>
            <a class="btn btn-info btn-sm" href="{{url('user')}}">
                Listar todos
            </a>
        </div>
    </th>
</tr>
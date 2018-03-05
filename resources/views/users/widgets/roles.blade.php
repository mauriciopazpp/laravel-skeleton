
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
                         <span class="label label-warning pull-right">
                           {{$role->users->count()}}
                         </span>
                       </a>
                           <span class="product-description">
                             {{$role->name}}
                           </span>
                     </div>
                   </li>
               </a>
           @endforeach
          </ul>
            @foreach($user->roles as $role)
              <p><label>Usuários do grupo {{$role->name}}</label></p>
              @foreach($role->users as $user)
                <a title="{{$user->name}}" href="{{url('/user/' . $user->id . '/show')}}">
                    <img width="45" src='{{url('/user/picture/' . ($user->picture ? $user->picture : 'name.png'))}}' class="img-circle" alt="{{$user->name}}" />
                </a>
              @endforeach
            @endforeach
          @else
          <small>Este usuário não está em nenhum grupo.</small>
          @endif
        </div>
        <div class="box-footer text-center">
          <a href="{{url('role')}}" class="uppercase">Ver todos os grupos </a>
        </div>
      </div>

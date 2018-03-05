<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Membros</h3>

    <div class="box-tools pull-right">
      <span class="label label-danger">{{App\Model\User::count()}} membros</span>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
      </button>
    </div>
  </div>
  <div class="box-body no-padding">
    <ul class="users-list clearfix">
        @foreach(App\Model\User::all() as $user)
          <li>
            <img src="{{url('user/picture/' . $user->picture)}}">
            <a class="users-list-name" href="{{url('user/' . $user->id . '/show')}}">{{$user->name}}</a>
            <span class="users-list-date">{{Auth::user()->created_at->diffForHumans()}}</span>
          </li>
        @endforeach
    </ul>
  </div>
  <div class="box-footer text-center">
    <a href="{{url('/user')}}" class="uppercase">Ver todos</a>
  </div>
</div>
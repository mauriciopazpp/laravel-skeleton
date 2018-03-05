 <li>
    <img src="{{url('/user/picture/' . $user->picture )}}" alt="User Image" width="{{isset($size) ? $size : 75}}" 
    height="{{isset($size) ? $size : 75}}">
    <a class="users-list-name" href="{{url('user/' . $user->id . '/show')}}">{{$user->name}}</a>
</li>
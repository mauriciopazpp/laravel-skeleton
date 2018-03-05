<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <div class="user-panel">
            <div class="pull-left image">
                <img src='{{url('/user/picture/' . ( Auth::user()->picture ?  Auth::user()->picture : 'name.png'))}}' class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p style="font-size: 12px;">{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-clock-o text-info"></i><span class="text-info text-bold">Hora atual:</span>  <span id="clock"></span></a>
            </div>
        </div>
        {!! $sidebar->asUl(['class' => 'sidebar-menu']) !!}
    </section>
</aside>
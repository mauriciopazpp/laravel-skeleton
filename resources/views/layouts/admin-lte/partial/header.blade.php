<!-- Main Header -->
<header class="main-header">

    <a href="{{url('/')}}" class="logo">
        <span class="logo-mini">
            {!!ENV('APP_NAME_SHORT_2')!!}
        </span>
        <span class="">
            {!!ENV('APP_NAME_SHORT_1')!!}
        </span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" 
        data-toggle="tooltip" data-placement="bottom" id="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </a> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu dropdown-notification-li">
                    <a href="#" class="dropdown-toggle dropdown-notification" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell"></i>
                        <span class="label label-danger pending-count" style="font-size: 13px"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-notification" style="border: 1px solid #3C8DBC;width: 600px!important;">
                        <li>
                            <div>
                                <ul class="menu menu-notification pending-links"></ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src='{{url('/user/picture/' . Auth::user()->picture)}}' class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">
                            Perfil
                        </span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img id="user-img" src='{{url('/')}}/user/picture/{{Auth::user()->picture}}' 
                            class="img-circle" alt="User Image" />
                            <p>
                                {{Auth::user()->name}}
                                <small>Membro {{Auth::user()->created_at->diffForHumans()}} - <small>{{Auth::user()->created_at->format('d/m/Y')}}</small> </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/')}}/user/{{Auth::user()->id}}/show" class="btn btn-default btn-flat"><span class="fa fa-user text-warning"></span> Meu perfil</a>
                            </div>
                            <div class="pull-right">
                                <a onclick="return confirm('Tem certeza que deseja sair do sistema?')" 
                                href="{{url('/')}}/logout" class="btn btn-default btn-flat"> 
                                <span class="fa fa-sign-out text-warning"></span> Sair do sistema
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
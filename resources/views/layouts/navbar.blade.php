<header class="main-header">
    <!-- Logo -->
    <a href="{{url('dashboard')}}" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{URL::asset('img/logo.png')}}" class="img-responsive logo"></span>
        <span class="logo-mini"><img src="{{URL::asset('img/icon.png')}}" class="img-responsive logo"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="cant_notificaciones"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header" id="cant_notificaciones_header"></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;" id="notificaciones">

                                </ul>
                                <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px;"></div>
                                <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>

                            </div>
                        </li>
                        <li class="footer"><a href="{{url('notifications')}}">Show all notifications</a></li>
                    </ul>
                </li>


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle"></i>
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: 80px">
                            <p>
                                {{Auth::user()->name}}
                                <small>{{Auth::user()->updated_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                           
                                <a href="{{url('profile')}}" class="btn btn-default btn-flat">Account</a>
                           
                                @if(!Auth::user()->isAdmin())
                                <a href="{{url('subscriptions')}}" class="btn btn-default btn-flat">Subscription</a>       
                                <a href="{{url('importData')}}" class="btn btn-default btn-flat">Import Data</a>
                                @endif
                                                            
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Logout</a>
                            
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
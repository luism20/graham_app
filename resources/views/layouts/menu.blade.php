<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li>
                <a href="{{url('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->isAdmin())
            <li>
                <a href="{{ url("plans") }}">
                    <i class="fa fa-usd"></i> <span>Plans</span>
                </a>
            </li>
            <li>
                <a href="{{ url("users") }}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ url("api_key") }}">
                    <i class="fa fa-truck"></i> <span>Api Key</span>
                </a>
            </li>
            <li>
                <a href="{{ url("configurations") }}">
                    <i class="fa fa-crop"></i> <span>Configurations</span>
                </a>
            </li>
            @else
            <li>
                <a href="{{  url("profitability") }}">
                    <i class="fa fa-line-chart"></i> <span>Profitability Analysis</span>
                </a>
            </li>
            <li>
                <a href="{{  url("asset") }}">
                    <i class="fa fa-pie-chart"></i> <span>Asset Analysis</span>
                </a>
            </li>
            <li>
                <a href="{{ url("leverage") }}">
                    <i class="fa fa-bar-chart"></i> <span>Leverage Analysis</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

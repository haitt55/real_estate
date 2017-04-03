<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('admin.home.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.project.index') }}"><i class="fa fa-file-o fa-fw"></i> Dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.position.index') }}"><i class="fa fa-map-marker fa-fw"></i> Vị trí dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.customer.index') }}"><i class="fa fa-user fa-fw"></i> Khách hàng</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
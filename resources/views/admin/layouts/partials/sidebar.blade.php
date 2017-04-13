<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('admin.home.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.main_project.index') }}"><i class="fa fa-file-o fa-fw"></i> Dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.project.index') }}"><i class="fa fa-file-o fa-fw"></i> Sản phẩm đang bán</a>
            </li>
            <li>
                <a href="{{ route('admin.position.index') }}"><i class="fa fa-map-marker fa-fw"></i> Vị trí dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.ground.index') }}"><i class="fa fa-tree fa-fw"></i> Mặt bằng dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.utility.index') }}"><i class="fa fa-wrench fa-fw"></i> Tiện ích dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.pricePolicy.index') }}"><i class="fa fa-usd fa-fw"></i> Bảng giá và Chính sách dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.new.index') }}"><i class="fa fa-newspaper-o fa-fw"></i>Tin tức dự án</a>
            </li>
            <li>
                <a href="{{ route('admin.customer.index') }}"><i class="fa fa-user fa-fw"></i> Khách hàng</a>
            </li>
            <li>
                <a href="{{ route('admin.image.index') }}"><i class="fa fa-image fa-fw"></i> Kho ảnh</a>
            </li>
            <li>
                <a href="{{ route('admin.appSettings.general') }}"><i class="fa fa-wrench fa-fw"></i> Thông tin chung</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Quản Trị</li>
                <li>
                    <a href="" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>

                    </a>


                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Quản lý Tải Khoản </span>

                    </a>

                </li>



                <li class="menu-title">Kinh Doanh</li>


                <li>
                    <a class="tp-link" href="{{route('admins.danhmucs.index') }}" >
                        <i data-feather="package"></i>
                        <span>  Danh Mục Sản Phẩm</span>

                    </a>


                    <a  class="tp-link" href="{{route('admins.sanpham.index') }}" >
                        <i data-feather="align-center"></i>
                        <span>  Sản Phẩm</span>

                    </a>
                    <a  class="tp-link" href="{{route('admins.donhangs.index') }}" >
                        <i data-feather="align-center"></i>
                        <span>  Đơn Hàng</span>

                    </a>
                </li>



            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
